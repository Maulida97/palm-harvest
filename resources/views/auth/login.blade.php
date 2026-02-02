<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login - PalmHarvest</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        "primary": "#66bd0f",
                        "background-light": "#f7f8f6",
                        "surface-light": "#fafcf8",
                        "surface-border": "#edf3e7",
                        "text-main": "#141b0d",
                        "text-secondary": "#739a4c",
                    },
                    fontFamily: {
                        "display": ["Inter", "sans-serif"]
                    },
                },
            },
        }
    </script>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Material Symbols -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
</head>
<body class="font-display bg-background-light min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-md">
        <!-- Logo & Brand -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-primary/20 rounded-full mb-4">
                <span class="material-symbols-outlined text-primary text-4xl">eco</span>
            </div>
            <h1 class="text-2xl font-bold text-text-main">PalmHarvest</h1>
            <p class="text-text-secondary text-sm mt-1">Sistem Monitoring Panen Sawit</p>
        </div>
        
        <!-- Login Card -->
        <div class="bg-white rounded-xl border border-surface-border shadow-lg p-8">
            <h2 class="text-lg font-bold text-text-main mb-6 text-center">Masuk ke Akun Anda</h2>
            
            <!-- Session Status -->
            @if (session('status'))
                <div class="mb-4 p-3 bg-green-50 border border-green-200 text-green-700 rounded-lg text-sm">
                    {{ session('status') }}
                </div>
            @endif
            
            <!-- Error Messages -->
            @if ($errors->any())
                <div class="mb-4 p-3 bg-red-50 border border-red-200 text-red-700 rounded-lg text-sm">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif
            
            <form method="POST" action="{{ route('login') }}" class="space-y-4">
                @csrf
                
                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-text-main mb-1">Email</label>
                    <div class="relative">
                        <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-text-secondary text-[20px]">mail</span>
                        <input type="email" name="email" id="email" required autofocus
                               value="{{ old('email') }}"
                               placeholder="email@example.com"
                               class="w-full h-11 pl-10 pr-4 rounded-lg border border-surface-border focus:ring-2 focus:ring-primary/20 focus:border-primary text-sm">
                    </div>
                </div>
                
                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-text-main mb-1">Password</label>
                    <div class="relative">
                        <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-text-secondary text-[20px]">lock</span>
                        <input type="password" name="password" id="password" required
                               placeholder="••••••••"
                               class="w-full h-11 pl-10 pr-4 rounded-lg border border-surface-border focus:ring-2 focus:ring-primary/20 focus:border-primary text-sm">
                    </div>
                </div>
                
                <!-- Remember Me -->
                <div class="flex items-center justify-between">
                    <label class="flex items-center">
                        <input type="checkbox" name="remember" class="w-4 h-4 rounded border-surface-border text-primary focus:ring-primary/20">
                        <span class="ml-2 text-sm text-text-secondary">Ingat saya</span>
                    </label>
                </div>
                
                <!-- Submit -->
                <button type="submit" 
                        class="w-full h-11 bg-primary hover:bg-primary/90 text-white rounded-lg font-semibold transition-colors flex items-center justify-center gap-2 shadow-lg shadow-primary/30">
                    <span class="material-symbols-outlined text-[20px]">login</span>
                    Masuk
                </button>
            </form>
        </div>
        
        <!-- Footer -->
        <p class="text-center text-text-secondary text-xs mt-6">
            &copy; {{ date('Y') }} PalmHarvest. All rights reserved.
        </p>
    </div>
</body>
</html>
