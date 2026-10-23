<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ลงทะเบียน - IT Maintenance Portal</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&family=Outfit:wght@700;800;900&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .brand-title { font-family: 'Outfit', sans-serif; }
    </style>
</head>
<body class="bg-gradient-to-br from-slate-950 via-blue-950 to-slate-900 min-h-screen flex items-center justify-center text-slate-100 antialiased py-12 px-4 relative overflow-hidden">
    <div class="max-w-md w-full mx-auto text-center relative z-10">
        <h1 class="brand-title text-3xl md:text-4xl font-extrabold tracking-tight bg-gradient-to-r from-blue-400 via-indigo-200 to-orange-400 bg-clip-text text-transparent">
            ลงทะเบียนใช้งานระบบ
        </h1>
        <p class="text-xs text-orange-400 font-extrabold tracking-[0.25em] uppercase mt-2">IT Service & Maintenance Portal</p>

        <div class="mt-8 bg-slate-900/80 backdrop-blur-2xl border border-slate-700/80 rounded-[2.5rem] p-8 shadow-2xl text-left">
            @if($errors->any())
                <div class="mb-6 bg-rose-500/20 border border-rose-500/40 p-4 rounded-2xl text-xs text-rose-200 font-bold">
                    {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('register') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-1.5">ชื่อ-นามสกุล</label>
                    <input type="text" name="name" required placeholder="สมชาย ใจดี" class="w-full bg-slate-950/80 border border-slate-700/80 rounded-2xl px-4 py-3 text-sm text-white focus:ring-2 focus:ring-orange-500 focus:outline-none">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-1.5">อีเมลองค์กร</label>
                    <input type="email" name="email" required placeholder="name@enterprise.com" class="w-full bg-slate-950/80 border border-slate-700/80 rounded-2xl px-4 py-3 text-sm text-white focus:ring-2 focus:ring-orange-500 focus:outline-none">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-1.5">รหัสผ่าน</label>
                    <input type="password" name="password" required placeholder="อย่างน้อย 6 ตัวอักษร" class="w-full bg-slate-950/80 border border-slate-700/80 rounded-2xl px-4 py-3 text-sm text-white focus:ring-2 focus:ring-orange-500 focus:outline-none">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-1.5">ยืนยันรหัสผ่าน</label>
                    <input type="password" name="password_confirmation" required placeholder="ยืนยันรหัสผ่านอีกครั้ง" class="w-full bg-slate-950/80 border border-slate-700/80 rounded-2xl px-4 py-3 text-sm text-white focus:ring-2 focus:ring-orange-500 focus:outline-none">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-1.5">เลือกบทบาท (Role)</label>
                    <select name="role" class="w-full bg-slate-950/80 border border-slate-700/80 rounded-2xl px-4 py-3 text-sm text-white focus:ring-2 focus:ring-orange-500 focus:outline-none cursor-pointer">
                        <option value="user">👤 พนักงานทั่วไป (ผู้แจ้งซ่อม)</option>
                        <option value="admin">🛠️ ทีมช่าง / แอดมิน (ผู้ดูแลระบบ)</option>
                    </select>
                </div>

                <button type="submit" class="w-full mt-4 bg-gradient-to-r from-blue-600 to-orange-500 hover:from-blue-500 text-white font-extrabold py-3.5 rounded-2xl shadow-lg shadow-orange-500/20 transition text-sm">
                    ลงทะเบียนใช้งาน →
                </button>
            </form>

            <div class="mt-6 text-center text-xs text-slate-400">
                มีบัญชีอยู่แล้ว? <a href="{{ route('login') }}" class="text-orange-400 font-bold hover:underline">เข้าสู่ระบบ</a>
            </div>
        </div>
    </div>
</body>
</html>