<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>الإشعارات - إكسابها</title>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    @livewireStyles
    <style>
        body { font-family: 'Tajawal', sans-serif; }
        .gradient-bg {
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 50%, #cbd5e1 100%);
            position: relative;
        }
        .gradient-bg::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: 
                radial-gradient(circle at 30% 20%, rgba(139, 92, 246, 0.05) 0%, transparent 50%),
                radial-gradient(circle at 70% 80%, rgba(59, 130, 246, 0.05) 0%, transparent 50%);
        }
    </style>
</head>
<body class="gradient-bg min-h-screen" dir="rtl">
    <x-navbar />

    <section class="py-12 relative z-10">
        <div class="container mx-auto px-4">
            <h2 class="text-4xl font-bold text-gray-900 mb-8 text-center">الإشعارات</h2>

            <div class="max-w-4xl mx-auto">
                @livewire('notifications-list')
            </div>
        </div>
    </section>

    @livewireScripts
</body>
</html>
