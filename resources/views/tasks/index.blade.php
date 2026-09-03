<x-app-layout>

    <div class="min-h-screen bg-slate-50 py-8" dir="rtl">

        <div class="max-w-7xl mx-auto px-6">

            {{-- Header --}}
            <div class="flex items-center justify-between mb-8">

                <div>
                    <h1 class="text-3xl font-bold text-slate-800">
                        المهام
                    </h1>

                    <p class="text-slate-500 mt-2">
                        إدارة ومتابعة جميع مهام المشاريع
                    </p>
                </div>

                <a href="{{ route('tasks.create') }}"
                   class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-xl font-semibold transition">
                    + إضافة مهمة
                </a>

            </div>

            {{-- Success Message --}}
            @if(session('success'))
                <div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-5 py-4 rounded-xl">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Error Message --}}
            @if(session('error'))
                <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-5 py-4 rounded-xl">
                    {{ session('error') }}
                </div>
            @endif

            {{-- Tasks Table --}}
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">

                <div class="overflow-x-auto">

                    <table class="w-full text-right">

                        <thead class="bg-slate-100 border-b border-slate-200">

                            <tr>

                                <th class="px-6 py-4 text-sm font-bold text-slate-600">
                                    المهمة
                                </th>

                                <th class="px-6 py-4 text-sm font-bold text-slate-600">
                                    المشروع
                                </th>

                                <th class="px-6 py-4 text-sm font-bold text-slate-600">
                                    المسؤول
                                </th>

                                <th class="px-6 py-4 text-sm font-bold text-slate-600">
                                    الأولوية
                                </th>

                                <th class="px-6 py-4 text-sm font-bold text-slate-600">
                                    الحالة
                                </th>

                                <th class="px-6 py-4 text-sm font-bold text-slate-600">
                                    تاريخ التسليم
                                </th>

                                <th class="px-6 py-4 text-sm font-bold text-slate-600">
                                    الإجراءات
                                </th>

                            </tr>

                        </thead>

                        <tbody class="divide-y divide-slate-100">

                            @forelse($tasks as $task)

                                <tr class="hover:bg-slate-50 transition">

                                    {{-- Title --}}
                                    <td class="px-6 py-5">

                                        <div class="font-semibold text-slate-800">
                                            {{ $task->title }}
                                        </div>

                                        @if($task->description)

                                            <div class="text-sm text-slate-500 mt-1">
                                                {{ \Illuminate\Support\Str::limit($task->description, 50) }}
                                            </div>

                                        @endif

                                    </td>

                                    {{-- Project --}}
                                    <td class="px-6 py-5 text-slate-600">

                                        {{ $task->project?->name ?? 'بدون مشروع' }}

                                    </td>

                                    {{-- User --}}
                                    <td class="px-6 py-5 text-slate-600">

                                        {{ $task->user?->name ?? 'غير محدد' }}

                                    </td>

                                    {{-- Priority --}}
                                    <td class="px-6 py-5">

                                        @if($task->priority === 'high')

                                            <span class="px-3 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-700">
                                                عالية
                                            </span>

                                        @elseif($task->priority === 'medium')

                                            <span class="px-3 py-1 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-700">
                                                متوسطة
                                            </span>

                                        @else

                                            <span class="px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700">
                                                منخفضة
                                            </span>

                                        @endif

                                    </td>

                                    {{-- Status --}}
                                    <td class="px-6 py-5">

                                        @if($task->status === 'completed')

                                            <span class="px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700">
                                                مكتملة
                                            </span>

                                        @elseif($task->status === 'in_progress')

                                            <span class="px-3 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-700">
                                                قيد التنفيذ
                                            </span>

                                        @else

                                            <span class="px-3 py-1 rounded-full text-xs font-semibold bg-slate-100 text-slate-700">
                                                معلقة
                                            </span>

                                        @endif

                                    </td>

                                    {{-- Due Date --}}
                                    <td class="px-6 py-5 text-slate-600">

                                        @if($task->due_date)

                                            {{ \Carbon\Carbon::parse($task->due_date)->format('Y-m-d') }}

                                        @else

                                            <span class="text-slate-400">
                                                غير محدد
                                            </span>

                                        @endif

                                    </td>

                                    {{-- Actions --}}
                                    <td class="px-6 py-5">

                                        <div class="flex items-center gap-2">

                                            {{-- Show --}}
                                            <a href="{{ route('tasks.show', $task) }}"
                                               class="px-3 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-lg text-sm transition">
                                                عرض
                                            </a>

                                            {{-- Edit --}}
                                            <a href="{{ route('tasks.edit', $task) }}"
                                               class="px-3 py-2 bg-blue-100 hover:bg-blue-200 text-blue-700 rounded-lg text-sm transition">
                                                تعديل
                                            </a>

                                            {{-- Delete --}}
                                            <form action="{{ route('tasks.destroy', $task) }}"
                                                  method="POST"
                                                  onsubmit="return confirm('هل أنت متأكد من حذف هذه المهمة؟')">

                                                @csrf

                                                @method('DELETE')

                                                <button type="submit"
                                                        class="px-3 py-2 bg-red-100 hover:bg-red-200 text-red-700 rounded-lg text-sm transition">
                                                    حذف
                                                </button>

                                            </form>

                                        </div>

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="7" class="px-6 py-16 text-center">

                                        <div class="text-5xl mb-4">
                                            📋
                                        </div>

                                        <h3 class="text-xl font-bold text-slate-700">
                                            لا توجد مهام حتى الآن
                                        </h3>

                                        <p class="text-slate-500 mt-2 mb-6">
                                            ابدأ بإضافة أول مهمة للمشروع
                                        </p>

                                        <a href="{{ route('tasks.create') }}"
                                           class="inline-block bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-xl font-semibold">
                                            + إضافة أول مهمة
                                        </a>

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>