<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ระบบบริหารจัดการงานซ่อม - ทีมช่างและแอดมิน</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Plus Jakarta Sans', sans-serif; }</style>
</head>
<body class="bg-slate-100 text-slate-800 antialiased">
    <nav class="bg-gradient-to-r from-slate-900 via-indigo-950 to-slate-900 text-white shadow-xl">
        <div class="max-w-7xl mx-auto px-6 h-20 flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <div class="bg-indigo-600 p-2.5 rounded-2xl shadow-lg shadow-indigo-500/30">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                </div>
                <div>
                    <span class="font-extrabold text-xl tracking-wide bg-gradient-to-r from-white to-indigo-200 bg-clip-text text-transparent">TECHNICIAN COMMAND CENTER</span>
                    <span class="block text-xs text-indigo-300 font-medium tracking-wider">ระบบบริหารจัดการงานซ่อมบำรุง • ทีมช่าง / ผู้ดูแลระบบ</span>
                </div>
            </div>
            
            <div class="flex items-center space-x-4">
                <span class="bg-indigo-900/60 border border-indigo-500/40 text-indigo-200 text-xs px-4 py-2 rounded-xl font-bold">🛠️ สถานะ: ออนไลน์ (ช่างพร้อมปฏิบัติงาน)</span>
                <a href="{{ route('login') }}" class="bg-slate-800 hover:bg-rose-600 text-slate-200 hover:text-white px-4 py-2.5 rounded-xl font-semibold border border-slate-700 transition flex items-center space-x-2 text-sm shadow-md">
                    <span>🚪</span>
                    <span>ออกจากระบบ</span>
                </a>
            </div>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto px-6 py-10">
        @if(session('success'))
            <div class="mb-8 bg-emerald-50 border border-emerald-200 p-4 rounded-2xl shadow-sm flex items-center space-x-3 text-emerald-800 font-semibold">
                <svg class="w-6 h-6 text-emerald-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <!-- Stats Overview -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-10">
            <div class="bg-white p-6 rounded-3xl shadow-sm border border-slate-200/60 flex items-center justify-between">
                <div>
                    <p class="text-xs font-bold uppercase tracking-wider text-slate-400">งานแจ้งซ่อมทั้งหมด</p>
                    <h3 class="text-3xl font-extrabold text-slate-800 mt-2">{{ $stats['total'] }}</h3>
                </div>
                <div class="bg-indigo-50 p-4 rounded-2xl text-indigo-600 text-xl font-bold">📊</div>
            </div>
            <div class="bg-white p-6 rounded-3xl shadow-sm border border-slate-200/60 flex items-center justify-between">
                <div>
                    <p class="text-xs font-bold uppercase tracking-wider text-amber-500">รอดำเนินการ</p>
                    <h3 class="text-3xl font-extrabold text-amber-600 mt-2">{{ $stats['pending'] }}</h3>
                </div>
                <div class="bg-amber-50 p-4 rounded-2xl text-amber-600 text-xl">⏳</div>
            </div>
            <div class="bg-white p-6 rounded-3xl shadow-sm border border-slate-200/60 flex items-center justify-between">
                <div>
                    <p class="text-xs font-bold uppercase tracking-wider text-blue-500">กำลังซ่อม</p>
                    <h3 class="text-3xl font-extrabold text-blue-600 mt-2">{{ $stats['in_progress'] }}</h3>
                </div>
                <div class="bg-blue-50 p-4 rounded-2xl text-blue-600 text-xl">🛠️</div>
            </div>
            <div class="bg-white p-6 rounded-3xl shadow-sm border border-slate-200/60 flex items-center justify-between">
                <div>
                    <p class="text-xs font-bold uppercase tracking-wider text-emerald-500">ซ่อมสำเร็จ</p>
                    <h3 class="text-3xl font-extrabold text-emerald-600 mt-2">{{ $stats['success'] }}</h3>
                </div>
                <div class="bg-emerald-50 p-4 rounded-2xl text-emerald-600 text-xl">✅</div>
            </div>
        </div>

        <!-- Repair Table Management -->
        <div class="bg-white rounded-3xl shadow-sm border border-slate-200/60 overflow-hidden">
            <div class="p-8 border-b border-slate-100 flex items-center justify-between">
                <div>
                    <h2 class="text-xl font-bold text-slate-800">รายการแจ้งซ่อมทั้งหมดในระบบ</h2>
                    <p class="text-xs text-slate-400 mt-1">อัปเดตสถานะและจัดการงานซ่อมได้ทันทีจากแผงควบคุมนี้</p>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50/80 text-slate-500 text-xs uppercase tracking-wider font-bold border-b border-slate-100">
                            <th class="py-4 px-6">ID / วันที่</th>
                            <th class="py-4 px-6">ผู้แจ้งซ่อม</th>
                            <th class="py-4 px-6">รหัส / ชื่ออุปกรณ์</th>
                            <th class="py-4 px-6">อาการเสีย</th>
                            <th class="py-4 px-6">ความด่วน</th>
                            <th class="py-4 px-6">สถานะปัจจุบัน</th>
                            <th class="py-4 px-6 text-right">จัดการสถานะ (ช่าง)</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-sm">
                        @forelse($repairs as $repair)
                        <tr class="hover:bg-slate-50/60 transition">
                            <td class="py-5 px-6">
                                <span class="font-extrabold text-indigo-600">#{{ $repair->id }}</span>
                                <span class="block text-xs text-slate-400 mt-0.5">{{ $repair->created_at->format('d/m/Y H:i') }}</span>
                            </td>
                            <td class="py-5 px-6">
                                <span class="font-bold text-slate-800">{{ $repair->reporter_name }}</span>
                            </td>
                            <td class="py-5 px-6">
                                <span class="font-bold text-slate-700">{{ $repair->equipment_name }}</span>
                                <span class="block text-xs font-mono text-indigo-500 font-semibold mt-0.5">{{ $repair->equipment_code }}</span>
                            </td>
                            <td class="py-5 px-6 max-w-xs text-slate-600">
                                <p class="truncate">{{ $repair->problem_detail }}</p>
                            </td>
                            <td class="py-5 px-6">
                                @if($repair->urgency == 'urgent') <span class="px-3 py-1 rounded-full text-xs font-bold bg-rose-100 text-rose-700">🔴 ด่วนที่สุด</span>
                                @elseif($repair->urgency == 'high') <span class="px-3 py-1 rounded-full text-xs font-bold bg-orange-100 text-orange-700">🟠 สูง</span>
                                @elseif($repair->urgency == 'medium') <span class="px-3 py-1 rounded-full text-xs font-bold bg-amber-100 text-amber-700">🟡 ปานกลาง</span>
                                @else <span class="px-3 py-1 rounded-full text-xs font-bold bg-slate-100 text-slate-700">🟢 ปกติ</span> @endif
                            </td>
                            <td class="py-5 px-6">
                                @if($repair->status == 'pending') <span class="px-3.5 py-1.5 rounded-full text-xs font-bold bg-amber-50 text-amber-600 border border-amber-200">⏳ รอดำเนินการ</span>
                                @elseif($repair->status == 'in_progress') <span class="px-3.5 py-1.5 rounded-full text-xs font-bold bg-blue-50 text-blue-600 border border-blue-200">🛠️ กำลังซ่อม</span>
                                @elseif($repair->status == 'success') <span class="px-3.5 py-1.5 rounded-full text-xs font-bold bg-emerald-50 text-emerald-600 border border-emerald-200">✅ ซ่อมสำเร็จ</span>
                                @else <span class="px-3.5 py-1.5 rounded-full text-xs font-bold bg-rose-50 text-rose-600 border border-rose-200">❌ ยกเลิก</span> @endif
                            </td>
                            <td class="py-5 px-6 text-right">
                                <form action="{{ route('repairs.updateStatus', $repair->id) }}" method="POST">
                                    @csrf @method('PATCH')
                                    <select name="status" onchange="this.form.submit()" class="text-xs bg-slate-50 border border-slate-300 rounded-xl px-3 py-2 font-semibold text-slate-700 focus:ring-2 focus:ring-indigo-500 shadow-sm cursor-pointer">
                                        <option value="pending" {{ $repair->status == 'pending' ? 'selected' : '' }}>⏳ รอดำเนินการ</option>
                                        <option value="in_progress" {{ $repair->status == 'in_progress' ? 'selected' : '' }}>🛠️ กำลังซ่อม</option>
                                        <option value="success" {{ $repair->status == 'success' ? 'selected' : '' }}>✅ ซ่อมสำเร็จ</option>
                                        <option value="rejected" {{ $repair->status == 'rejected' ? 'selected' : '' }}>❌ ยกเลิก</option>
                                    </select>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="7" class="py-16 text-center text-slate-400 font-medium">ยังไม่มีรายการแจ้งซ่อมในระบบ</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="p-6 border-t border-slate-100">{{ $repairs->links() }}</div>
        </div>
    </div>
</body>
</html>