<x-app-layout>

    <div class="min-h-screen bg-slate-50 py-8" dir="rtl">

        <div class="max-w-4xl mx-auto px-6">

            {{-- Header --}}
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-slate-800">
                    تعديل المهمة
                </h1>

                <p class="text-slate-500 mt-2">
                    تعديل بيانات المهمة: {{ $task->title }}
                </p>
            </div>

            {{-- Errors --}}
            @if($errors->any())
                <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-5 py-4 rounded-xl">

                    <ul class="list-disc mr-5 space-y-1">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>

                </div>
            @endif

            {{-- Form --}}
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8">

                <form action="{{ route('tasks.update', $task) }}" method="POST">

                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        {{-- Title --}}
                        <div class="md:col-span-2">

                            <label class="block text-sm font-bold text-slate-700 mb-2">
                                اسم المهمة
                            </label>

                            <input
                                type="text"
                                name="title"
                                value="{{ old('title', $task->title) }}"
                                required
                                class="w-full rounded-xl border-slate-300 focus:border-indigo-500 focus:ring-indigo-500"
                                placeholder="مثال: تصميم واجهة الموقع">

                        </div>

                        {{-- Project --}}
                        <div>

                            <label class="block text-sm font-bold text-slate-700 mb-2">
                                المشروع
                            </label>

                            <select
                                name="project_id"
                                required
                                class="w-full rounded-xl border-slate-300 focus:border-indigo-500 focus:ring-indigo-500">

                                @foreach($projects as $project)

                                    <option
                                        value="{{ $project->id }}"
                                        {{ old('project_id', $task->project_id) == $project->id ? 'selected' : '' }}>

                                        {{ $project->name }}

                                    </option>

                                @endforeach

                            </select>

                        </div>

                        {{-- User --}}
                        <div>

                            <label class="block text-sm font-bold text-slate-700 mb-2">
                                المسؤول عن المهمة
                            </label>

                            <select
                                name="user_id"
                                class="w-full rounded-xl border-slate-300 focus:border-indigo-500 focus:ring-indigo-500">

                                <option value="">
                                    غير محدد
                                </option>

                                @foreach($users as $user)

                                    <option
                                        value="{{ $user->id }}"
                                        {{ old('user_id', $task->user_id) == $user->id ? 'selected' : '' }}>

                                        {{ $user->name }}

                                    </option>

                                @endforeach

                            </select>

                        </div>

                        {{-- Status --}}
                        <div>

                            <label class="block text-sm font-bold text-slate-700 mb-2">
                                الحالة
                            </label>

                            <select
                                name="status"
                                required
                                class="w-full rounded-xl border-slate-300 focus:border-indigo-500 focus:ring-indigo-500">

                                <option value="pending"
                                    {{ old('status', $task->status) === 'pending' ? 'selected' : '' }}>
                                    معلقة
                                </option>

                                <option value="in_progress"
                                    {{ old('status', $task->status) === 'in_progress' ? 'selected' : '' }}>
                                    قيد التنفيذ
                                </option>

                                <option value="completed"
                                    {{ old('status', $task->status) === 'completed' ? 'selected' : '' }}>
                                    مكتملة
                                </option>

                            </select>

                        </div>

                        {{-- Priority --}}
                        <div>

                            <label class="block text-sm font-bold text-slate-700 mb-2">
                                الأولوية
                            </label>

                            <select
                                name="priority"
                                required
                                class="w-full rounded-xl border-slate-300 focus:border-indigo-500 focus:ring-indigo-500">

                                <option value="low"
                                    {{ old('priority', $task->priority) === 'low' ? 'selected' : '' }}>
                                    منخفضة
                                </option>

                                <option value="medium"
                                    {{ old('priority', $task->priority) === 'medium' ? 'selected' : '' }}>
                                    متوسطة
                                </option>

                                <option value="high"
                                    {{ old('priority', $task->priority) === 'high' ? 'selected' : '' }}>
                                    عالية
                                </option>

                            </select>

                        </div>

                        {{-- Due Date --}}
                        <div>

                            <label class="block text-sm font-bold text-slate-700 mb-2">
                                تاريخ التسليم
                            </label>

                            <input
                                type="date"
                                name="due_date"
                                value="{{ old('due_date', $task->due_date ? \Carbon\Carbon::parse($task->due_date)->format('Y-m-d') : '') }}"
                                class="w-full rounded-xl border-slate-300 focus:border-indigo-500 focus:ring-indigo-500">

                        </div>

                        {{-- Description --}}
                        <div class="md:col-span-2">

                            <label class="block text-sm font-bold text-slate-700 mb-2">
                                وصف المهمة
                            </label>

                            <textarea
                                name="description"
                                rows="5"
                                class="w-full rounded-xl border-slate-300 focus:border-indigo-500 focus:ring-indigo-500"
                                placeholder="اكتب وصف المهمة هنا...">{{ old('description', $task->description) }}</textarea>

                        </div>

                    </div>

                    {{-- Buttons --}}
                    <div class="flex items-center justify-end gap-3 mt-8">

                        <a href="{{ route('tasks.show', $task) }}"
                           class="px-6 py-3 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold transition">
                            إلغاء
                        </a>

                        <button
                            type="submit"
                            class="px-6 py-3 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white font-semibold transition">

                            حفظ التعديلات

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</x-app-layout>