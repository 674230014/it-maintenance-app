<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เข้าสู่ระบบ - IT Maintenance Portal</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&family=Outfit:wght@700;800;900&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .brand-title { font-family: 'Outfit', sans-serif; }
    </style>
</head>
<body class="bg-gradient-to-br from-slate-950 via-blue-950 to-slate-900 min-h-screen flex items-center justify-center text-slate-100 antialiased py-12 px-4 relative overflow-hidden">
    <!-- Glow Background Effects -->
    <div class="absolute -top-40 -left-40 w-96 h-96 bg-blue-600/20 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-40 -right-40 w-96 h-96 bg-orange-600/20 rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-md w-full mx-auto text-center relative z-10">
        <div class="mb-5 flex justify-center">
            <div class="bg-gradient-to-tr from-blue-600 to-orange-500 p-4 rounded-3xl shadow-2xl shadow-blue-500/40 border border-blue-400/30">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
            </div>
        </div>

        <!-- ชื่อเว็บดีไซน์เด่นสะดุดตา ไล่สีน้ำเงิน-ส้ม -->
        <h1 class="brand-title text-3xl md:text-4xl font-extrabold tracking-tight bg-gradient-to-r from-blue-400 via-indigo-200 to-orange-400 bg-clip-text text-transparent drop-shadow-sm">
            IT Service & Maintenance
        </h1>
        <p class="text-xs text-orange-400 font-extrabold tracking-[0.25em] uppercase mt-2">Enterprise Support & Repair Portal</p>

        <div class="mt-8 bg-slate-900/80 backdrop-blur-2xl border border-slate-700/80 rounded-[2.5rem] p-8 shadow-2xl text-left">
            @if($errors->any())
                <div class="mb-6 bg-rose-500/20 border border-rose-500/40 p-4 rounded-2xl text-xs text-rose-200 font-bold flex items-center space-x-2">
                    <span>⚠️</span>
                    <span>{{ $errors->first() }}</span>
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST" class="space-y-5">
                @csrf
                <div>
                    <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">อีเมลองค์กร (Corporate Email)</label>
                    <input type="email" name="email" required placeholder="name@enterprise.com" class="w-full bg-slate-950/80 border border-slate-700/80 rounded-2xl px-5 py-3.5 text-sm font-medium text-white placeholder-slate-500 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 focus:outline-none transition shadow-inner">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">รหัสผ่าน (Password)</label>
                    <input type="password" name="password" required placeholder="••••••••" class="w-full bg-slate-950/80 border border-slate-700/80 rounded-2xl px-5 py-3.5 text-sm font-medium text-white placeholder-slate-500 focus:ring-2 focus:ring-orange-500 focus:border-orange-500 focus:outline-none transition shadow-inner">
                </div>

                <button type="submit" class="w-full mt-3 bg-gradient-to-r from-blue-600 to-orange-500 hover:from-blue-500 hover:to-orange-400 text-white font-extrabold py-4 rounded-2xl shadow-xl shadow-orange-500/20 transition transform hover:-translate-y-0.5 active:translate-y-0 text-sm">
                    เข้าสู่ระบบ →
                </button>
            </form>

            <div class="mt-8 pt-6 border-t border-slate-800 text-center text-xs text-slate-400 font-medium">
                ยังไม่มีบัญชีผู้ใช้งาน? <a href="{{ route('register') }}" class="text-orange-400 font-bold hover:text-orange-300 underline">สมัครสมาชิกที่นี่</a>
            </div>
        </div>
    </div>
</body>
</html>