<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IT Technician Portal - แดชบอร์ดทีมช่าง</title>
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
                <div class="bg-gradient-to-tr from-blue-600 to-orange-500 p-2.5 rounded-2xl shadow-lg shadow-orange-500/20 text-white font-bold">🛠️</div>
                <div>
                    <span class="brand-title text-lg tracking-wider bg-gradient-to-r from-white via-slate-200 to-orange-400 bg-clip-text text-transparent">IT TECHNICIAN COMMAND CENTER</span>
                    <span class="block text-xs text-orange-400 font-medium">ระบบบริหารจัดการงานซ่อมและตรวจสอบสลิปการเงิน</span>
                </div>
            </div>
            <div>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="bg-slate-800 hover:bg-orange-600 text-white px-4 py-2.5 rounded-xl font-semibold border border-slate-700 transition text-sm shadow-md">🚪 ออกจากระบบ</button>
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

        <!-- Stats Overview Dashboard -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-slate-900/80 backdrop-blur-xl p-6 rounded-[2rem] shadow-xl border border-slate-800 flex items-center justify-between">
                <div>
                    <p class="text-xs font-bold uppercase tracking-wider text-slate-400">งานทั้งหมด</p>
                    <h3 class="text-3xl font-extrabold text-white mt-2">{{ $stats['total'] }}</h3>
                </div>
                <div class="bg-blue-500/20 p-4 rounded-2xl text-blue-400 text-xl font-bold shadow-inner">📊</div>
            </div>
            <div class="bg-slate-900/80 backdrop-blur-xl p-6 rounded-[2rem] shadow-xl border border-slate-800 flex items-center justify-between">
                <div>
                    <p class="text-xs font-bold uppercase tracking-wider text-amber-400">รอดำเนินการ</p>
                    <h3 class="text-3xl font-extrabold text-amber-400 mt-2">{{ $stats['pending'] }}</h3>
                </div>
                <div class="bg-amber-500/20 p-4 rounded-2xl text-amber-400 text-xl shadow-inner">⏳</div>
            </div>
            <div class="bg-slate-900/80 backdrop-blur-xl p-6 rounded-[2rem] shadow-xl border border-slate-800 flex items-center justify-between">
                <div>
                    <p class="text-xs font-bold uppercase tracking-wider text-orange-400">กำลังซ่อม</p>
                    <h3 class="text-3xl font-extrabold text-orange-400 mt-2">{{ $stats['in_progress'] }}</h3>
                </div>
                <div class="bg-orange-500/20 p-4 rounded-2xl text-orange-400 text-xl shadow-inner">🛠️</div>
            </div>
            <div class="bg-slate-900/80 backdrop-blur-xl p-6 rounded-[2rem] shadow-xl border border-slate-800 flex items-center justify-between">
                <div>
                    <p class="text-xs font-bold uppercase tracking-wider text-emerald-400">ซ่อมสำเร็จ</p>
                    <h3 class="text-3xl font-extrabold text-emerald-400 mt-2">{{ $stats['success'] }}</h3>
                </div>
                <div class="bg-emerald-500/20 p-4 rounded-2xl text-emerald-400 text-xl shadow-inner">✅</div>
            </div>
        </div>

        <!-- Table Management -->
        <div class="bg-slate-900/80 backdrop-blur-2xl rounded-[2.5rem] shadow-2xl border border-slate-800 overflow-hidden">
            <div class="p-8 border-b border-slate-800">
                <h2 class="text-xl font-bold text-white">รายการแจ้งซ่อมและจัดการค่าใช้จ่าย</h2>
                <p class="text-xs text-slate-400 mt-1">กำหนดราคาค่าซ่อม ตรวจสอบสลิป หรือยกเลิกงานที่ไม่อยู่ในเงื่อนไข</p>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-950/60 text-slate-400 text-xs uppercase tracking-wider font-bold border-b border-slate-800">
                            <th class="py-4 px-6">ID / ผู้แจ้ง</th>
                            <th class="py-4 px-6">อุปกรณ์ / อาการ</th>
                            <th class="py-4 px-6">สถานะงาน</th>
                            <th class="py-4 px-6">ค่าใช้จ่าย & สลิปโอนเงิน</th>
                            <th class="py-4 px-6 text-right">จัดการระบบ</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-800 text-sm">
                        @forelse($repairs as $repair)
                        <tr class="hover:bg-slate-800/40 transition align-top">
                            <td class="py-5 px-6">
                                <span class="font-extrabold text-blue-400">#{{ $repair->id }}</span>
                                <span class="block text-xs font-bold text-slate-200 mt-0.5">{{ $repair->reporter_name }}</span>
                                <span class="block text-[11px] text-slate-400">{{ $repair->created_at->format('d/m/Y H:i') }}</span>
                            </td>
                            <td class="py-5 px-6 max-w-xs">
                                <span class="font-bold text-slate-200">{{ $repair->equipment_name }}</span>
                                <span class="block text-xs font-mono text-orange-400 font-semibold">{{ $repair->equipment_code }}</span>
                                <p class="text-xs text-slate-400 mt-1">{{ $repair->problem_detail }}</p>
                            </td>
                            <td class="py-5 px-6">
                                @if($repair->status == 'pending') <span class="px-3 py-1 rounded-full text-xs font-bold bg-amber-500/20 text-amber-300 border border-amber-500/30">⏳ รอดำเนินการ</span>
                                @elseif($repair->status == 'in_progress') <span class="px-3 py-1 rounded-full text-xs font-bold bg-orange-500/20 text-orange-300 border border-orange-500/30">🛠️ กำลังซ่อม</span>
                                @elseif($repair->status == 'success') <span class="px-3 py-1 rounded-full text-xs font-bold bg-emerald-500/20 text-emerald-300 border border-emerald-500/30">✅ ซ่อมสำเร็จ</span>
                                @else <span class="px-3 py-1 rounded-full text-xs font-bold bg-rose-500/20 text-rose-300 border border-rose-500/30">❌ ยกเลิก</span> @endif
                            </td>
                            <td class="py-5 px-6 space-y-2">
                                @if($repair->slip_path)
                                    <div class="bg-slate-950/60 p-3.5 rounded-2xl border border-slate-800 shadow-sm">
                                        <p class="text-xs font-bold text-slate-300 mb-1">สลิปโอนเงินของลูกค้า:</p>
                                        <a href="{{ asset('storage/' . $repair->slip_path) }}" target="_blank" class="text-orange-400 font-bold text-xs hover:underline flex items-center space-x-1">
                                            <span>🔍 คลิกดูรูปสลิปเต็มจอ</span>
                                        </a>
                                        <div class="mt-2.5">
                                            @if($repair->payment_status == 'pending_approval')
                                                <form action="{{ route('repairs.approveSlip', $repair->id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="w-full bg-emerald-600 hover:bg-emerald-500 text-white text-xs font-bold py-2 px-3 rounded-xl shadow">
                                                        ✅ อนุมัติสลิปโอนเงิน
                                                    </button>
                                                </form>
                                            @elseif($repair->payment_status == 'paid')
                                                <span class="text-xs font-bold text-emerald-300 bg-emerald-500/20 px-2.5 py-1.5 rounded-xl border border-emerald-500/30 block text-center">✔ ชำระเงินเรียบร้อยแล้ว</span>
                                            @endif
                                        </div>
                                    </div>
                                @else
                                    <span class="text-xs text-slate-500 italic">ลูกค่ายังไม่ได้แนบสลิป</span>
                                @endif
                            </td>
                            <td class="py-5 px-6 text-right">
                                @if($repair->payment_status == 'paid')
                                    <div class="bg-slate-950/60 border border-slate-800 p-4 rounded-2xl text-xs text-slate-300 text-center font-bold space-y-1">
                                        <span class="text-emerald-400 block">🔒 ปิดงานสมบูรณ์แล้ว</span>
                                        <span class="text-[11px] text-slate-400 font-normal block">ยอดเงิน: ฿{{ number_format($repair->price, 2) }}</span>
                                    </div>
                                @elseif($repair->status == 'rejected')
                                    <div class="bg-rose-950/40 border border-rose-500/30 p-4 rounded-2xl text-xs text-rose-300 text-center font-bold space-y-1 shadow-sm">
                                        <span class="block text-sm">❌ งานถูกยกเลิกแล้ว</span>
                                        <span class="text-[11px] text-rose-400 font-normal block">ไม่สามารถแก้ไขข้อมูลได้อีก</span>
                                    </div>
                                @else
                                    <form action="{{ route('repairs.updateStatus', $repair->id) }}" method="POST" class="space-y-2.5 inline-block text-left w-64">
                                        @csrf @method('PATCH')
                                        <select name="status" class="w-full text-xs bg-slate-950 border border-slate-700 rounded-xl px-3 py-2 font-semibold text-white">
                                            <option value="pending" {{ $repair->status == 'pending' ? 'selected' : '' }}>⏳ รอดำเนินการ</option>
                                            <option value="in_progress" {{ $repair->status == 'in_progress' ? 'selected' : '' }}>🛠️ กำลังซ่อม</option>
                                            <option value="success" {{ $repair->status == 'success' ? 'selected' : '' }}>✅ ซ่อมสำเร็จ (ปิดงาน)</option>
                                            <option value="rejected" {{ $repair->status == 'rejected' ? 'selected' : '' }}>❌ ยกเลิก</option>
                                        </select>
                                        <input type="number" name="price" value="{{ $repair->price }}" step="0.01" placeholder="ค่าใช้จ่าย (บาท)" class="w-full text-xs bg-slate-950 border border-slate-700 rounded-xl px-3 py-2 font-bold text-orange-400 placeholder-slate-500">
                                        <textarea name="repair_details" rows="2" placeholder="รายละเอียดการซ่อม..." class="w-full text-xs bg-slate-950 border border-slate-700 rounded-xl p-2 text-white placeholder-slate-500">{{ $repair->repair_details }}</textarea>
                                        <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-orange-500 hover:from-blue-500 hover:to-orange-400 text-white font-bold text-xs py-2.5 rounded-xl shadow-lg shadow-orange-500/20">💾 บันทึกข้อมูล</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="5" class="py-16 text-center text-slate-500 font-medium">ยังไม่มีรายการแจ้งซ่อมในระบบ</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="p-6 border-t border-slate-800">{{ $repairs->links() }}</div>
        </div>
    </div>
</body>
</html>