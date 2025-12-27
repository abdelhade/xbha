<x-admin-layout>
    <div class="mb-8">
        <h2 class="text-3xl font-bold text-white">إعدادات الموقع</h2>
    </div>

    <div class="glass-panel p-8 max-w-2xl">
        <form action="{{ route('admin.settings.update') }}" method="POST" class="space-y-6">
            @csrf

            <div>
                <label class="block text-gray-300 mb-2">اسم الموقع</label>
                <input type="text" name="site_name" value="{{ $settings['site_name'] ?? config('app.name') }}"
                    class="w-full bg-gray-900/50 border border-gray-700 rounded-lg p-3 text-white focus:border-purple-500 focus:ring-1 focus:ring-purple-500 outline-none transition">
            </div>

            <div>
                <label class="block text-gray-300 mb-2">بريد الدعم الفني</label>
                <input type="email" name="support_email" value="{{ $settings['support_email'] ?? '' }}"
                    class="w-full bg-gray-900/50 border border-gray-700 rounded-lg p-3 text-white focus:border-purple-500 focus:ring-1 focus:ring-purple-500 outline-none transition">
            </div>

            <div class="flex items-center gap-3">
                <input type="checkbox" id="sms" name="sms_notifications" value="1"
                    {{ !empty($settings['sms_notifications']) ? 'checked' : '' }}
                    class="w-5 h-5 rounded border-gray-700 bg-gray-900/50 text-purple-600 focus:ring-purple-500">
                <label for="sms" class="text-gray-300 select-none">تفعيل إشعارات SMS</label>
            </div>

            <div class="pt-4 border-t border-white/5">
                <button type="submit"
                    class="bg-gradient-to-r from-purple-600 to-indigo-600 hover:from-purple-500 hover:to-indigo-500 text-white font-bold py-3 px-8 rounded-lg shadow-lg shadow-purple-900/50 transition transform hover:-translate-y-0.5">
                    حفظ الإعدادات
                </button>
            </div>

            @if (session('message'))
                <div class="p-4 bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 rounded-lg">
                    {{ session('message') }}
                </div>
            @endif
        </form>
    </div>
</x-admin-layout>
