<?php

namespace App\Exports;

use App\Models\Purchase;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Events\AfterSheet;

class PurchasesExport implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize, WithEvents
{
    public function __construct(private readonly User $user)
    {
    }

    /**
     * @return Builder<Purchase>
     */
    public function query(): Builder
    {
        return Purchase::query()
            ->with('category')
            ->where('user_id', $this->user->id)
            ->latest('purchase_date');
    }

    public function headings(): array
    {
        return [
            'Titulo',
            'Descripcion',
            'Categoria',
            'Valor COP',
            'Fecha',
            'Proveedor',
            'Metodo de pago',
        ];
    }

    public function map($purchase): array
    {
        return [
            $purchase->title,
            $purchase->description,
            $purchase->category?->name,
            '$ '.number_format($purchase->amount, 0, ',', '.'),
            $purchase->purchase_date?->format('Y-m-d'),
            $purchase->provider,
            $purchase->payment_method,
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $total = $this->user->purchases()->sum('amount');

                $event->sheet->setCellValue('L1', 'Total gastos');
                $event->sheet->setCellValue('L2', '$ '.number_format($total, 0, ',', '.'));
                $event->sheet->getStyle('A1:G1')->getFont()->setBold(true);
                $event->sheet->getStyle('L1:L2')->getFont()->setBold(true);
            },
        ];
    }
}
