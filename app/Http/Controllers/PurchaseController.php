<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PurchaseController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->user()->purchases()->with('category')->latest('purchase_date');

        if ($request->filled('search')) {
            $search = $request->string('search');

            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('provider', 'like', "%{$search}%");
            });
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->integer('category_id'));
        }

        return view('purchases.index', [
            'purchases' => $query->paginate(10)->withQueryString(),
            'categories' => $request->user()->categories()->orderBy('name')->get(),
        ]);
    }

    public function create(Request $request)
    {
        return view('purchases.create', [
            'categories' => $request->user()->categories()->orderBy('name')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $request->user()->purchases()->create($this->validatedData($request));

        return redirect()->route('purchases.index')->with('status', 'Compra registrada.');
    }

    public function show(Purchase $purchase)
    {
        abort_unless($purchase->user_id === auth()->id(), 403);

        return view('purchases.show', [
            'purchase' => $purchase->load('category'),
        ]);
    }

    public function edit(Purchase $purchase)
    {
        abort_unless($purchase->user_id === auth()->id(), 403);

        return view('purchases.edit', [
            'purchase' => $purchase,
            'categories' => auth()->user()->categories()->orderBy('name')->get(),
        ]);
    }

    public function update(Request $request, Purchase $purchase)
    {
        abort_unless($purchase->user_id === $request->user()->id, 403);

        $purchase->update($this->validatedData($request));

        return redirect()->route('purchases.index')->with('status', 'Compra actualizada.');
    }

    public function destroy(Purchase $purchase)
    {
        abort_unless($purchase->user_id === auth()->id(), 403);

        $purchase->delete();

        return redirect()->route('purchases.index')->with('status', 'Compra eliminada.');
    }

    public function export(Request $request)
    {
        $purchases = $request->user()
            ->purchases()
            ->with('category')
            ->latest('purchase_date')
            ->get();

        $total = $purchases->sum('amount');

        $html = view('purchases.export', [
            'purchases' => $purchases,
            'total' => $total,
        ])->render();

        return response($html, Response::HTTP_OK, [
            'Content-Type' => 'application/vnd.ms-excel; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="compras.xls"',
            'Cache-Control' => 'max-age=0, no-cache, no-store, must-revalidate',
            'Pragma' => 'public',
        ]);
    }

    private function validatedData(Request $request): array
    {
        $request->merge([
            'amount' => preg_replace('/\D/', '', (string) $request->input('amount')),
        ]);

        return $request->validate([
            'category_id' => [
                'required',
                'integer',
                'exists:categories,id',
                function (string $attribute, mixed $value, \Closure $fail) use ($request) {
                    if (! $request->user()->categories()->whereKey($value)->exists()) {
                        $fail('La categoria seleccionada no es valida.');
                    }
                },
            ],
            'title' => ['required', 'string', 'max:120'],
            'description' => ['nullable', 'string', 'max:1000'],
            'amount' => ['required', 'integer', 'min:0', 'max:999999999999'],
            'purchase_date' => ['required', 'date'],
            'provider' => ['nullable', 'string', 'max:120'],
            'payment_method' => ['nullable', 'string', 'max:80'],
        ]);
    }
}
