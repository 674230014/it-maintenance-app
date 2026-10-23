<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แจ้งซ่อมบำรุงอุปกรณ์ - IT Service Center</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Outfit:wght@700;800;900&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .brand-title { font-family: 'Outfit', sans-serif; }
    </style>
</head>
<body class="bg-gradient-to-br from-slate-950 via-blue-950 to-slate-900 text-slate-100 min-h-screen antialiased py-12 px-4">
    <div class="max-w-3xl mx-auto">
        <div class="mb-6 flex items-center justify-between">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="text-xs font-bold text-rose-400 hover:text-rose-300 flex items-center space-x-1 transition bg-slate-900/80 px-4 py-2.5 rounded-2xl shadow-sm border border-slate-700">
                    <span>🚪 ออกจากระบบ</span>
                </button>
            </form>
            <div class="flex items-center space-x-3">
                <a href="{{ route('repairs.history') }}" class="bg-gradient-to-r from-blue-600 to-orange-500 hover:from-blue-500 text-white text-xs font-bold px-5 py-3 rounded-2xl shadow-lg shadow-orange-500/20 transition flex items-center space-x-1.5">
                    <span>📋 ดูประวัติ / ชำระเงิน</span>
                </a>
            </div>
        </div>

        @if(session('success'))
            <script>
                window.addEventListener('DOMContentLoaded', () => {
                    Swal.fire({
                        icon: 'success',
                        title: 'ส่งเรื่องแจ้งซ่อมสำเร็จ!',
                        text: '{{ session("success") }}',
                        confirmButtonText: 'ตกลง',
                        confirmButtonColor: '#f97316',
                        timer: 3500,
                        timerProgressBar: true
                    });
                });
            </script>
        @endif

        <div class="bg-slate-900/80 backdrop-blur-2xl rounded-[2.5rem] shadow-2xl border border-slate-800 overflow-hidden">
            <div class="bg-gradient-to-r from-slate-950 via-blue-950 to-slate-900 text-white p-10 relative border-b border-slate-800">
                <div class="absolute right-8 top-8 text-4xl opacity-20">💻</div>
                <h1 class="brand-title text-2xl font-extrabold tracking-wide text-white">ฟอร์มแจ้งซ่อมบำรุงอุปกรณ์ไอที</h1>
                <p class="text-orange-400 text-xs font-medium mt-1">เลือกประเภทอุปกรณ์และกรอกรายละเอียดอาการเสียเพื่อให้ทีมช่างผู้เชี่ยวชาญเข้าตรวจสอบทันที</p>
            </div>

            <form action="{{ route('repairs.store') }}" method="POST" enctype="multipart/form-data" class="p-10 space-y-6">
                @csrf
                
                <div>
                    <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">ชื่อ-นามสกุล ผู้แจ้งซ่อม</label>
                    <input type="text" name="reporter_name" required placeholder="เช่น สมชาย ใจดี" class="w-full bg-slate-950/80 border border-slate-700 rounded-2xl px-5 py-3.5 text-sm font-medium text-white placeholder-slate-500 focus:ring-2 focus:ring-orange-500 focus:outline-none transition shadow-inner">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">ประเภทอุปกรณ์ (Asset Category)</label>
                        <select name="equipment_code" class="w-full bg-slate-950/80 border border-slate-700 rounded-2xl px-5 py-3.5 text-sm font-semibold text-white focus:ring-2 focus:ring-orange-500 focus:outline-none transition shadow-inner cursor-pointer">
                            <option value="EQ-PC-001" class="bg-slate-900">🖥️ คอมพิวเตอร์ตั้งโต๊ะ (Desktop PC)</option>
                            <option value="EQ-NB-002" class="bg-slate-900">💻 โน้ตบุ๊ก (Laptop / Notebook)</option>
                            <option value="EQ-PRT-003" class="bg-slate-900">🖨️ เครื่องพิมพ์ (Printer)</option>
                            <option value="EQ-AC-004" class="bg-slate-900">❄️ เครื่องปรับอากาศ (Air Conditioner)</option>
                            <option value="EQ-NET-005" class="bg-slate-900">🌐 อุปกรณ์เครือข่าย / Wi-Fi Router</option>
                            <option value="EQ-OTH-006" class="bg-slate-900">🔌 อื่นๆ (Others)</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">ชื่อรุ่น / ยี่ห้ออุปกรณ์ (Brand / Model)</label>
                        <input type="text" name="equipment_name" required placeholder="เช่น Dell OptiPlex / HP LaserJet Pro" class="w-full bg-slate-950/80 border border-slate-700 rounded-2xl px-5 py-3.5 text-sm font-medium text-white placeholder-slate-500 focus:ring-2 focus:ring-orange-500 focus:outline-none transition shadow-inner">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">ระดับความเร่งด่วน</label>
                        <select name="urgency" class="w-full bg-slate-950/80 border border-slate-700 rounded-2xl px-5 py-3.5 text-sm font-semibold text-white focus:ring-2 focus:ring-orange-500 focus:outline-none transition shadow-inner cursor-pointer">
                            <option value="normal" class="bg-slate-900">🟢 ปกติ (ใช้งานต่อได้)</option>
                            <option value="medium" class="bg-slate-900">🟡 ปานกลาง</option>
                            <option value="high" class="bg-slate-900">🟠 สูง (กระทบงานบางส่วน)</option>
                            <option value="urgent" class="bg-slate-900">🔴 ด่วนที่สุด (ระบบหยุดทำงาน)</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">แนบรูปภาพอาการเสีย (ถ้ามี)</label>
                        <input type="file" name="image" class="w-full text-xs text-slate-400 file:mr-4 file:py-3 file:px-5 file:rounded-2xl file:border-0 file:text-xs file:font-bold file:bg-orange-500/20 file:text-orange-300 hover:file:bg-orange-500/30 transition cursor-pointer">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">รายละเอียดอาการเสีย / ปัญหาที่พบ</label>
                    <textarea name="problem_detail" rows="4" required placeholder="อธิบายรายละเอียดอาการเสีย เช่น เครื่องเปิดไม่ติด จอฟ้า มีเสียงดังผิดปกติ..." class="w-full bg-slate-950/80 border border-slate-700 rounded-2xl px-5 py-3.5 text-sm font-medium text-white placeholder-slate-500 focus:ring-2 focus:ring-orange-500 focus:outline-none transition shadow-inner"></textarea>
                </div>

                <div class="pt-6 flex items-center justify-between border-t border-slate-800">
                    <a href="{{ route('repairs.history') }}" class="px-6 py-3.5 rounded-2xl border border-slate-700 text-xs font-bold text-slate-300 hover:bg-slate-800 transition">📋 ดูประวัติทั้งหมด</a>
                    <button type="submit" class="bg-gradient-to-r from-blue-600 to-orange-500 hover:from-blue-500 text-white px-8 py-3.5 rounded-2xl font-bold text-xs shadow-xl shadow-orange-500/20 transition transform hover:-translate-y-0.5">ยืนยันส่งเรื่องแจ้งซ่อม →</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>