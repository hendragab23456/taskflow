<x-app-layout>

    <div class="min-h-screen bg-slate-100" dir="rtl">

        {{-- Header --}}
        <div class="border-b border-slate-200 bg-white">
            <div class="mx-auto max-w-5xl px-6 py-7">

                <div class="flex items-center justify-between">

                    <div class="flex items-center gap-3">

                        <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-indigo-600 text-2xl text-white shadow-lg">
                            ✅
                        </div>

                        <div>
                            <h1 class="text-2xl font-bold text-slate-800">
                                إضافة مهمة جديدة
                            </h1>

                            <p class="mt-1 text-sm text-slate-500">
                                أضف مهمة جديدة وحدد المشروع والمسؤول عنها
                            </p>
                        </div>

                    </div>

                    <a href="{{ route('tasks.index') }}"
                       class="rounded-xl bg-slate-100 px-5 py-3 text-sm font-bold text-slate-600 transition hover:bg-slate-200">

                        ← العودة للمهام

                    </a>

                </div>

            </div>
        </div>


        {{-- Form --}}
        <main class="mx-auto max-w-5xl px-6 py-8">

            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">

                @if($errors->any())

                    <div class="mb-6 rounded-xl border border-red-200 bg-red-50 p-4 text-red-700">

                        <p class="mb-2 font-bold">
                            يوجد بعض الأخطاء:
                        </p>

                        <ul class="list-inside list-disc text-sm">

                            @foreach($errors->all() as $error)

                                <li>{{ $error }}</li>

                            @endforeach

                        </ul>

                    </div>

                @endif


                <form action="{{ route('tasks.store') }}"
                      method="POST"
                      class="space-y-6">

                    @csrf


                    {{-- Title --}}
                    <div>

                        <label class="mb-2 block text-sm font-bold text-slate-700">
                            اسم المهمة
                        </label>

                        <input type="text"
                               name="title"
                               value="{{ old('title') }}"
                               required
                               placeholder="مثال: تصميم واجهة المشروع"
                               class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">

                    </div>


                    {{-- Project + User --}}
                    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">

                        {{-- Project --}}
                        <div>

                            <label class="mb-2 block text-sm font-bold text-slate-700">
                                المشروع
                            </label>

                            <select name="project_id"
                                    required
                                    class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">

                                <option value="">
                                    اختر المشروع
                                </option>

                                @foreach($projects as $project)

                                    <option value="{{ $project->id }}"
                                        {{ old('project_id') == $project->id ? 'selected' : '' }}>

                                        {{ $project->name }}

                                    </option>

                                @endforeach

                            </select>

                        </div>


                        {{-- User --}}
                        <div>

                            <label class="mb-2 block text-sm font-bold text-slate-700">
                                المسؤول عن المهمة
                            </label>

                            <select name="user_id"
                                    class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">

                                <option value="">
                                    بدون مسؤول حاليًا
                                </option>

                                @foreach($users as $user)

                                    <option value="{{ $user->id }}"
                                        {{ old('user_id') == $user->id ? 'selected' : '' }}>

                                        {{ $user->name }}

                                    </option>

                                @endforeach

                            </select>

                        </div>

                    </div>


                    {{-- Description --}}
                    <div>

                        <label class="mb-2 block text-sm font-bold text-slate-700">
                            وصف المهمة
                        </label>

                        <textarea name="description"
                                  rows="5"
                                  placeholder="اكتب تفاصيل المهمة هنا..."
                                  class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">{{ old('description') }}</textarea>

                    </div>


                    {{-- Status + Priority + Date --}}
                    <div class="grid grid-cols-1 gap-6 md:grid-cols-3">

                        {{-- Status --}}
                        <div>

                            <label class="mb-2 block text-sm font-bold text-slate-700">
                                الحالة
                            </label>

                            <select name="status"
                                    required
                                    class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">

                                <option value="pending"
                                    {{ old('status', 'pending') === 'pending' ? 'selected' : '' }}>
                                    قيد الانتظار
                                </option>

                                <option value="in_progress"
                                    {{ old('status') === 'in_progress' ? 'selected' : '' }}>
                                    قيد التنفيذ
                                </option>

                                <option value="completed"
                                    {{ old('status') === 'completed' ? 'selected' : '' }}>
                                    مكتملة
                                </option>

                            </select>

                        </div>


                        {{-- Priority --}}
                        <div>

                            <label class="mb-2 block text-sm font-bold text-slate-700">
                                الأولوية
                            </label>

                            <select name="priority"
                                    required
                                    class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">

                                <option value="low"
                                    {{ old('priority', 'medium') === 'low' ? 'selected' : '' }}>
                                    منخفضة
                                </option>

                                <option value="medium"
                                    {{ old('priority', 'medium') === 'medium' ? 'selected' : '' }}>
                                    متوسطة
                                </option>

                                <option value="high"
                                    {{ old('priority') === 'high' ? 'selected' : '' }}>
                                    عالية
                                </option>

                            </select>

                        </div>


                        {{-- Due Date --}}
                        <div>

                            <label class="mb-2 block text-sm font-bold text-slate-700">
                                موعد الانتهاء
                            </label>

                            <input type="date"
                                   name="due_date"
                                   value="{{ old('due_date') }}"
                                   class="w-full rounded-xl border border-slate-300 px-4 py-3 text-sm outline-none transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">

                        </div>

                    </div>


                    {{-- Buttons --}}
                    <div class="flex flex-col gap-3 border-t border-slate-200 pt-6 sm:flex-row">

                        <button type="submit"
                                class="inline-flex items-center justify-center rounded-xl bg-indigo-600 px-6 py-3 text-sm font-bold text-white shadow-md transition hover:bg-indigo-700">

                            ✓ حفظ المهمة

                        </button>

                        <a href="{{ route('tasks.index') }}"
                           class="inline-flex items-center justify-center rounded-xl bg-slate-100 px-6 py-3 text-sm font-bold text-slate-600 transition hover:bg-slate-200">

                            إلغاء

                        </a>

                    </div>

                </form>

            </div>

        </main>

    </div>

</x-app-layout>