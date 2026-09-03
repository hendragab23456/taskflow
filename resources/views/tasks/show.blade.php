<x-app-layout>

    <div class="min-h-screen bg-slate-50 py-8" dir="rtl">

        <div class="max-w-5xl mx-auto px-6">

            {{-- Header --}}
            <div class="flex items-center justify-between mb-8">

                <div>
                    <h1 class="text-3xl font-bold text-slate-800">
                        تفاصيل المهمة
                    </h1>

                    <p class="text-slate-500 mt-2">
                        عرض جميع تفاصيل المهمة
                    </p>
                </div>

                <div class="flex gap-3">

                    <a href="{{ route('tasks.edit', $task) }}"
                       class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-3 rounded-xl font-semibold transition">
                        تعديل المهمة
                    </a>

                    <a href="{{ route('tasks.index') }}"
                       class="bg-white hover:bg-slate-100 border border-slate-200 text-slate-700 px-5 py-3 rounded-xl font-semibold transition">
                        ← رجوع
                    </a>

                </div>

            </div>

            {{-- Success --}}
            @if(session('success'))

                <div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-5 py-4 rounded-xl">
                    {{ session('success') }}
                </div>

            @endif

            {{-- Main Card --}}
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">

                {{-- Title --}}
                <div class="p-8 border-b border-slate-200">

                    <div class="flex items-start justify-between gap-6">

                        <div>

                            <p class="text-sm text-slate-400 mb-2">
                                اسم المهمة
                            </p>

                            <h2 class="text-3xl font-bold text-slate-800">
                                {{ $task->title }}
                            </h2>

                        </div>

                        {{-- Status --}}
                        <div>

                            @if($task->status === 'completed')

                                <span class="inline-block px-4 py-2 rounded-full text-sm font-semibold bg-green-100 text-green-700">
                                    ✓ مكتملة
                                </span>

                            @elseif($task->status === 'in_progress')

                                <span class="inline-block px-4 py-2 rounded-full text-sm font-semibold bg-blue-100 text-blue-700">
                                    قيد التنفيذ
                                </span>

                            @else

                                <span class="inline-block px-4 py-2 rounded-full text-sm font-semibold bg-slate-100 text-slate-700">
                                    معلقة
                                </span>

                            @endif

                        </div>

                    </div>

                </div>

                {{-- Details --}}
                <div class="p-8">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        {{-- Project --}}
                        <div class="bg-slate-50 rounded-xl p-5">

                            <p class="text-sm text-slate-400 mb-2">
                                المشروع
                            </p>

                            <p class="text-lg font-bold text-slate-800">
                                {{ $task->project?->name ?? 'بدون مشروع' }}
                            </p>

                        </div>

                        {{-- Responsible --}}
                        <div class="bg-slate-50 rounded-xl p-5">

                            <p class="text-sm text-slate-400 mb-2">
                                المسؤول عن المهمة
                            </p>

                            <p class="text-lg font-bold text-slate-800">
                                {{ $task->user?->name ?? 'غير محدد' }}
                            </p>

                        </div>

                        {{-- Priority --}}
                        <div class="bg-slate-50 rounded-xl p-5">

                            <p class="text-sm text-slate-400 mb-2">
                                الأولوية
                            </p>

                            @if($task->priority === 'high')

                                <span class="inline-block px-4 py-2 rounded-full text-sm font-semibold bg-red-100 text-red-700">
                                    عالية
                                </span>

                            @elseif($task->priority === 'medium')

                                <span class="inline-block px-4 py-2 rounded-full text-sm font-semibold bg-yellow-100 text-yellow-700">
                                    متوسطة
                                </span>

                            @else

                                <span class="inline-block px-4 py-2 rounded-full text-sm font-semibold bg-green-100 text-green-700">
                                    منخفضة
                                </span>

                            @endif

                        </div>

                        {{-- Due Date --}}
                        <div class="bg-slate-50 rounded-xl p-5">

                            <p class="text-sm text-slate-400 mb-2">
                                تاريخ التسليم
                            </p>

                            <p class="text-lg font-bold text-slate-800">

                                @if($task->due_date)

                                    {{ \Carbon\Carbon::parse($task->due_date)->format('Y-m-d') }}

                                @else

                                    <span class="text-slate-400">
                                        غير محدد
                                    </span>

                                @endif

                            </p>

                        </div>

                    </div>

                    {{-- Description --}}
                    <div class="mt-6">

                        <div class="bg-slate-50 rounded-xl p-6">

                            <p class="text-sm text-slate-400 mb-3">
                                وصف المهمة
                            </p>

                            @if($task->description)

                                <p class="text-slate-700 leading-8 whitespace-pre-line">
                                    {{ $task->description }}
                                </p>

                            @else

                                <p class="text-slate-400">
                                    لا يوجد وصف لهذه المهمة.
                                </p>

                            @endif

                        </div>

                    </div>

                </div>

                {{-- Footer --}}
                <div class="bg-slate-50 border-t border-slate-200 px-8 py-5">

                    <div class="flex items-center justify-between">

                        <div class="text-sm text-slate-500">

                            تم إنشاء المهمة:
                            {{ \Carbon\Carbon::parse($task->created_at)->format('Y-m-d') }}

                        </div>

                        <form action="{{ route('tasks.destroy', $task) }}"
                              method="POST"
                              onsubmit="return confirm('هل أنت متأكد من حذف هذه المهمة؟')">

                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                    class="text-red-600 hover:text-red-800 font-semibold">
                                حذف المهمة
                            </button>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>