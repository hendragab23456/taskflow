<x-app-layout>

    <div class="min-h-screen bg-slate-100" dir="rtl">

        {{-- Header --}}
        <div class="border-b border-slate-200 bg-white">
            <div class="mx-auto max-w-4xl px-6 py-7">

                <div class="flex items-center gap-4">

                    <a href="{{ route('projects.index') }}"
                       class="flex h-10 w-10 items-center justify-center rounded-xl bg-slate-100 text-slate-600 transition hover:bg-slate-200">
                        ←
                    </a>

                    <div>
                        <h1 class="text-2xl font-bold text-slate-800">
                            إنشاء مشروع جديد
                        </h1>

                        <p class="mt-1 text-sm text-slate-500">
                            أضف بيانات المشروع للبدء في متابعته
                        </p>
                    </div>

                </div>

            </div>
        </div>


        {{-- Form --}}
        <main class="mx-auto max-w-4xl px-6 py-8">

            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm sm:p-8">

                @if($errors->any())

                    <div class="mb-6 rounded-xl border border-red-200 bg-red-50 p-4">

                        <p class="font-bold text-red-700">
                            يوجد خطأ في البيانات
                        </p>

                        <ul class="mt-2 list-inside list-disc text-sm text-red-600">

                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach

                        </ul>

                    </div>

                @endif


                <form action="{{ route('projects.store') }}" method="POST">

                    @csrf


                    {{-- Project Name --}}
                    <div class="mb-6">

                        <label for="name"
                               class="mb-2 block text-sm font-bold text-slate-700">
                            اسم المشروع
                        </label>

                        <input
                            type="text"
                            name="name"
                            id="name"
                            value="{{ old('name') }}"
                            placeholder="مثال: تصميم موقع الشركة"
                            required
                            class="w-full rounded-xl border-slate-300 px-4 py-3 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        >

                    </div>


                    {{-- Description --}}
                    <div class="mb-6">

                        <label for="description"
                               class="mb-2 block text-sm font-bold text-slate-700">
                            وصف المشروع
                        </label>

                        <textarea
                            name="description"
                            id="description"
                            rows="4"
                            placeholder="اكتب وصفًا مختصرًا للمشروع..."
                            class="w-full rounded-xl border-slate-300 px-4 py-3 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        >{{ old('description') }}</textarea>

                    </div>


                    {{-- Dates --}}
                    <div class="mb-6 grid grid-cols-1 gap-5 md:grid-cols-2">

                        <div>

                            <label for="start_date"
                                   class="mb-2 block text-sm font-bold text-slate-700">
                                تاريخ البداية
                            </label>

                            <input
                                type="date"
                                name="start_date"
                                id="start_date"
                                value="{{ old('start_date') }}"
                                class="w-full rounded-xl border-slate-300 px-4 py-3 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            >

                        </div>


                        <div>

                            <label for="due_date"
                                   class="mb-2 block text-sm font-bold text-slate-700">
                                تاريخ الانتهاء
                            </label>

                            <input
                                type="date"
                                name="due_date"
                                id="due_date"
                                value="{{ old('due_date') }}"
                                class="w-full rounded-xl border-slate-300 px-4 py-3 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            >

                        </div>

                    </div>


                    {{-- Status --}}
                    <div class="mb-8">

                        <label for="status"
                               class="mb-2 block text-sm font-bold text-slate-700">
                            حالة المشروع
                        </label>

                        <select
                            name="status"
                            id="status"
                            class="w-full rounded-xl border-slate-300 px-4 py-3 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        >

                            <option value="planning"
                                {{ old('status') === 'planning' ? 'selected' : '' }}>
                                قيد التخطيط
                            </option>

                            <option value="in_progress"
                                {{ old('status') === 'in_progress' ? 'selected' : '' }}>
                                قيد التنفيذ
                            </option>

                            <option value="completed"
                                {{ old('status') === 'completed' ? 'selected' : '' }}>
                                مكتمل
                            </option>

                        </select>

                    </div>


                    {{-- Buttons --}}
                    <div class="flex flex-col-reverse gap-3 border-t border-slate-200 pt-6 sm:flex-row sm:justify-end">

                        <a href="{{ route('projects.index') }}"
                           class="inline-flex items-center justify-center rounded-xl bg-slate-100 px-6 py-3 text-sm font-bold text-slate-600 transition hover:bg-slate-200">
                            إلغاء
                        </a>

                        <button
                            type="submit"
                            class="inline-flex items-center justify-center gap-2 rounded-xl bg-indigo-600 px-6 py-3 text-sm font-bold text-white shadow-md transition hover:bg-indigo-700"
                        >
                            <span>✓</span>
                            حفظ المشروع
                        </button>

                    </div>

                </form>

            </div>

        </main>

    </div>

</x-app-layout>