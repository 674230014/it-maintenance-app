<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ประวัติและติดตามสถานะการแจ้งซ่อม - IT Portal</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Outfit:wght@700;800;900&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .brand-title { font-family: 'Outfit', sans-serif; }
    </style>
</head>
<body class="bg-gradient-to-br from-slate-950 via-blue-950 to-slate-900 text-slate-100 min-h-screen antialiased">
    <nav class="bg-slate-900/90 backdrop-blur-xl border-b border-slate-800 text-white shadow-2xl sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6 h-20 flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <div class="bg-gradient-to-tr from-blue-600 to-orange-500 p-2.5 rounded-2xl shadow-lg shadow-orange-500/20 text-white font-bold">📋</div>
                <div>
                    <span class="brand-title text-lg tracking-wider bg-gradient-to-r from-white via-slate-200 to-orange-400 bg-clip-text text-transparent">EMPLOYEE TRACKING PORTAL</span>
                    <span class="block text-xs text-orange-400 font-medium">ติดตามสถานะ ชำระเงิน และพิมพ์ใบเสร็จรับเงิน</span>
                </div>
            </div>
            <div class="flex items-center space-x-3">
                <a href="{{ route('repairs.create') }}" class="bg-gradient-to-r from-blue-600 to-orange-500 hover:from-blue-500 text-white px-5 py-2.5 rounded-2xl font-bold text-xs shadow-lg shadow-orange-500/20 transition">+ แจ้งซ่อมเพิ่ม</a>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="bg-slate-800 hover:bg-orange-600 text-white px-4 py-2.5 rounded-xl font-semibold text-xs border border-slate-700 transition">🚪 ออก</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto px-6 py-10">
        @if(session('success'))
            <script>
                window.addEventListener('DOMContentLoaded', () => {
                    Swal.fire({ icon: 'success', title: 'สำเร็จ!', text: '{{ session("success") }}', confirmButtonColor: '#f97316', timer: 3000 });
                });
            </script>
        @endif

        <div class="bg-slate-900/80 backdrop-blur-2xl rounded-[2.5rem] shadow-2xl border border-slate-800 overflow-hidden">
            <div class="p-8 border-b border-slate-800 flex items-center justify-between">
                <div>
                    <h2 class="text-xl font-bold text-white">ประวัติการแจ้งซ่อมและชำระเงิน</h2>
                    <p class="text-xs text-slate-400 mt-1">สแกน QR Code โอนเงิน แนบสลิป และรอช่างอนุมัติเพื่อพิมพ์ใบเสร็จ</p>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-950/60 text-slate-400 text-xs uppercase tracking-wider font-bold border-b border-slate-800">
                            <th class="py-4 px-6">ID / อุปกรณ์</th>
                            <th class="py-4 px-6">อาการเสีย & ผลงานช่าง</th>
                            <th class="py-4 px-6">สถานะงาน</th>
                            <th class="py-4 px-6">ค่าใช้จ่าย & QR โอนเงิน</th>
                            <th class="py-4 px-6 text-right">พิมพ์ใบเสร็จ</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-800 text-sm">
                        @forelse($repairs as $repair)
                        <tr class="hover:bg-slate-800/45 transition align-top">
                            <td class="py-5 px-6">
                                <span class="font-extrabold text-blue-400">#{{ $repair->id }}</span>
                                <span class="block font-bold text-slate-200 mt-0.5">{{ $repair->equipment_name }}</span>
                                <span class="block text-xs font-mono text-orange-400 font-semibold">{{ $repair->equipment_code }}</span>
                            </td>
                            <td class="py-5 px-6 text-slate-300 max-w-xs">
                                <p>{{ $repair->problem_detail }}</p>
                                @if($repair->repair_details)
                                    <div class="mt-2 bg-orange-950/40 border border-orange-500/30 p-3 rounded-2xl text-xs text-orange-200 font-medium">
                                        ✨ ช่างซ่อม: {{ $repair->repair_details }}
                                    </div>
                                @endif
                            </td>
                            <td class="py-5 px-6">
                                @if($repair->status == 'pending') <span class="px-3 py-1 rounded-full text-xs font-bold bg-amber-500/20 text-amber-300 border border-amber-500/40">⏳ รอดำเนินการ</span>
                                @elseif($repair->status == 'in_progress') <span class="px-3 py-1 rounded-full text-xs font-bold bg-orange-500/20 text-orange-300 border border-orange-500/40">🛠️ กำลังซ่อม</span>
                                @elseif($repair->status == 'success') <span class="px-3 py-1 rounded-full text-xs font-bold bg-emerald-500/20 text-emerald-300 border border-emerald-500/40">✅ ซ่อมสำเร็จ</span>
                                @else <span class="px-3 py-1 rounded-full text-xs font-bold bg-rose-500/20 text-rose-300 border border-rose-500/40">❌ ยกเลิก</span> @endif
                            </td>
                            <td class="py-5 px-6 space-y-3">
                                @if($repair->price > 0)
                                    <div class="bg-slate-950/60 p-4 rounded-2xl border border-slate-800 shadow-inner">
                                        <p class="text-xs font-bold text-slate-400">ยอดชำระ: <span class="text-orange-400 font-extrabold text-base">฿{{ number_format($repair->price, 2) }}</span></p>
                                        
                                        <div class="mt-3 flex items-center space-x-3 bg-slate-900 p-3 rounded-xl border border-slate-800">
                                            <img src="https://api.qrserver.com/v1/create-qr-code/?size=80x80&data=IT-Maintenance-PromptPay-{{ $repair->price }}" alt="QR PromptPay" class="w-14 h-14 rounded-lg shadow-sm bg-white p-1">
                                            <div class="text-[11px] text-slate-300 leading-tight">
                                                <p class="font-bold text-white">PromptPay QR</p>
                                                <p class="mt-0.5 text-slate-400">สแกนโอนค่าบริการไอที</p>
                                            </div>
                                        </div>

                                        <div class="mt-3">
                                            @if($repair->payment_status == 'unpaid')
                                                <form action="{{ route('repairs.uploadSlip', $repair->id) }}" method="POST" enctype="multipart/form-data" class="space-y-2">
                                                    @csrf
                                                    <input type="file" name="slip" required class="w-full text-xs text-slate-400 file:mr-2 file:py-1.5 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-orange-500/20 file:text-orange-300 hover:file:bg-orange-500/30 transition">
                                                    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-500 text-white font-bold text-xs py-2 rounded-xl shadow">📤 แนบสลิปโอนเงิน</button>
                                                </form>
                                            @elseif($repair->payment_status == 'pending_approval')
                                                <span class="text-xs font-bold text-amber-300 bg-amber-500/20 px-3 py-2 rounded-xl border border-amber-500/30 block text-center shadow-sm">⏳ แนบสลิปแล้ว (รอช่างตรวจสอบ)</span>
                                            @elseif($repair->payment_status == 'paid')
                                                <span class="text-xs font-bold text-emerald-300 bg-emerald-500/20 px-3 py-2 rounded-xl border border-emerald-500/30 block text-center shadow-sm">✔ ชำระเงินสำเร็จ (อนุมัติแล้ว)</span>
                                            @endif
                                        </div>
                                    </div>
                                @else
                                    <span class="text-xs text-slate-500 italic">รอช่างประเมินราคาค่าบริการ...</span>
                                @endif
                            </td>
                            <td class="py-5 px-6 text-right">
                                @if($repair->payment_status == 'paid')
                                    <a href="{{ route('repairs.receipt', $repair->id) }}" target="_blank" class="bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-500 text-white px-5 py-3 rounded-2xl font-bold text-xs shadow-lg shadow-emerald-500/20 inline-flex items-center space-x-1.5 transition">
                                        <span>🖨️ พิมพ์ใบเสร็จรับเงิน</span>
                                    </a>
                                @else
                                    <button disabled class="bg-slate-800 text-slate-500 px-5 py-3 rounded-2xl font-bold text-xs cursor-not-allowed border border-slate-700">
                                        🔒 ล็อค (รอช่างอนุมัติ)
                                    </button>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="5" class="py-16 text-center text-slate-500 font-medium">ยังไม่มีประวัติการแจ้งซ่อมในระบบ</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="p-6 border-t border-slate-800">{{ $repairs->links() }}</div>
        </div>
    </div>
</body>
</html>