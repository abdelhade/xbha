<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>المحادثات - Mazadi</title>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { font-family: 'Tajawal', sans-serif; }
        .gradient-bg { background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 50%, #cbd5e1 100%); }
    </style>
</head>
<body class="gradient-bg min-h-screen">
    <x-navbar />

    <section class="py-12">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto">
                <h2 class="text-3xl font-bold text-gray-900 mb-8">المحادثات</h2>
                @livewire('chat-list')
            </div>
        </div>
    </section>
</body>
</html>
