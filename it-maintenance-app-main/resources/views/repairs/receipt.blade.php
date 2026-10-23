<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ใบเสร็จรับเงิน / Receipt - #{{ $repair->id }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        @media print {
            body { background: white; }
            .no-print { display: none; }
        }
    </style>
</head>
<body class="bg-slate-100 text-slate-800 antialiased py-16 px-4">
    <div class="max-w-2xl mx-auto bg-white p-12 rounded-[2.5rem] shadow-2xl border border-slate-200">
        <div class="flex justify-between items-start border-b border-slate-100 pb-8">
            <div>
                <h1 class="text-2xl font-extrabold text-indigo-900 tracking-tight">IT SERVICE CENTER</h1>
                <p class="text-xs text-slate-500 mt-1 font-medium">ศูนย์บริการซ่อมบำรุงและสนับสนุนอุปกรณ์ไอทีองค์กร</p>
                <p class="text-xs text-slate-400 mt-0.5">บริษัท ไอที เซอร์วิส โซลูชั่นส์ จำกัด (สำนักงานใหญ่)</p>
            </div>
            <div class="text-right">
                <span class="bg-emerald-100 text-emerald-800 text-xs font-extrabold px-4 py-1.5 rounded-full uppercase tracking-wider">Paid / ชำระแล้ว</span>
                <p class="text-xs text-slate-400 mt-3">เลขที่ใบเสร็จ: <span class="font-bold text-slate-700">REC-2026-{{ str_pad($repair->id, 4, '0', STR_PAD_LEFT) }}</span></p>
                <p class="text-xs text-slate-400">วันที่: <span class="font-bold text-slate-700">{{ now()->format('d/m/Y H:i') }}</span></p>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-6 my-8 text-sm bg-slate-50 p-6 rounded-2xl border border-slate-100">
            <div>
                <p class="text-xs font-bold text-slate-400 uppercase">นามผู้แจ้งซ่อม / ลูกค้า</p>
                <p class="font-bold text-slate-800 mt-1">{{ $repair->reporter_name }}</p>
            </div>
            <div>
                <p class="text-xs font-bold text-slate-400 uppercase">รหัสทรัพย์สินอุปกรณ์</p>
                <p class="font-bold text-indigo-600 mt-1">{{ $repair->equipment_code }} ({{ $repair->equipment_name }})</p>
            </div>
        </div>

        <table class="w-full text-left border-collapse my-6">
            <thead>
                <tr class="bg-slate-50 text-slate-400 text-xs uppercase tracking-wider font-bold border-b border-slate-200">
                    <th class="py-3 px-4">รายการบริการซ่อม</th>
                    <th class="py-3 px-4 text-right">จำนวนเงิน (บาท)</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 text-sm">
                <tr>
                    <td class="py-5 px-4">
                        <p class="font-bold text-slate-800">ค่าบริการซ่อมบำรุงและตรวจเช็คอุปกรณ์ไอที</p>
                        <p class="text-xs text-slate-500 mt-1 font-medium">อาการเสีย: {{ $repair->problem_detail }}</p>
                        <p class="text-xs text-indigo-600 mt-0.5 font-semibold">ผลงานช่าง: {{ $repair->repair_details }}</p>
                    </td>
                    <td class="py-5 px-4 text-right font-extrabold text-slate-800 text-base">
                        ฿{{ number_format($repair->price, 2) }}
                    </td>
                </tr>
            </tbody>
        </table>

        <div class="border-t border-slate-200 pt-6 flex justify-between items-center bg-indigo-50/50 p-6 rounded-2xl">
            <span class="text-sm font-extrabold text-slate-700">ยอดรวมทั้งสิ้น (Net Total)</span>
            <span class="text-3xl font-extrabold text-indigo-600">฿{{ number_format($repair->price, 2) }}</span>
        </div>

        <div class="grid grid-cols-2 gap-10 mt-16 pt-8 border-t border-slate-100 text-center text-xs text-slate-500">
            <div>
                <div class="h-10 mb-2 border-b border-dashed border-slate-300 w-3/4 mx-auto"></div>
                <p class="font-bold text-slate-700">ผู้รับเงิน / เจ้าหน้าที่ช่าง</p>
            </div>
            <div>
                <div class="h-10 mb-2 border-b border-dashed border-slate-300 w-3/4 mx-auto"></div>
                <p class="font-bold text-slate-700">ผู้มีอำนาจลงนาม / Authorized Signature</p>
            </div>
        </div>

        <div class="mt-12 text-center no-print space-x-4">
            <button onclick="window.print()" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold px-8 py-3.5 rounded-2xl shadow-xl shadow-indigo-500/20 transition">🖨️ พิมพ์ใบเสร็จ</button>
            <a href="{{ route('repairs.history') }}" class="bg-slate-200 hover:bg-slate-300 text-slate-700 font-bold px-6 py-3.5 rounded-2xl transition inline-block">← กลับหน้าประวัติ</a>
        </div>
    </div>
</body>
</html>