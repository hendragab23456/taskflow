<x-app-layout>

    <div class="min-h-screen bg-slate-50 py-8" dir="rtl">

        <div class="max-w-7xl mx-auto px-6">

            {{-- Header --}}
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">

                <div>
                    <h1 class="text-3xl font-bold text-slate-800">
                        لوحة التحكم
                    </h1>

                    <p class="text-slate-500 mt-2">
                        مرحبًا {{ auth()->user()->name }} 👋
                        إليك ملخص المشاريع والمهام
                    </p>
                </div>

                <div class="flex gap-3">
                    <a href="{{ route('projects.create') }}"
                       class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-3 rounded-xl font-semibold transition">
                        + مشروع جديد
                    </a>

                    <a href="{{ route('tasks.create') }}"
                       class="bg-white hover:bg-slate-100 border border-slate-200 text-slate-700 px-5 py-3 rounded-xl font-semibold transition">
                        + مهمة جديدة
                    </a>
                </div>

            </div>

            {{-- Statistics --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-8">

                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-slate-500">إجمالي المشاريع</p>
                            <p class="text-3xl font-bold text-slate-800 mt-2">
                                {{ $totalProjects }}
                            </p>
                        </div>
                        <div class="w-12 h-12 rounded-xl bg-indigo-100 flex items-center justify-center text-2xl">
                            📁
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-slate-500">المشاريع النشطة</p>
                            <p class="text-3xl font-bold text-blue-600 mt-2">
                                {{ $activeProjects }}
                            </p>
                        </div>
                        <div class="w-12 h-12 rounded-xl bg-blue-100 flex items-center justify-center text-2xl">
                            🚀
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-slate-500">إجمالي المهام</p>
                            <p class="text-3xl font-bold text-purple-600 mt-2">
                                {{ $totalTasks }}
                            </p>
                        </div>
                        <div class="w-12 h-12 rounded-xl bg-purple-100 flex items-center justify-center text-2xl">
                            📋
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-slate-500">المهام المكتملة</p>
                            <p class="text-3xl font-bold text-green-600 mt-2">
                                {{ $completedTasks }}
                            </p>
                        </div>
                        <div class="w-12 h-12 rounded-xl bg-green-100 flex items-center justify-center text-2xl">
                            ✅
                        </div>
                    </div>
                </div>

            </div>

            {{-- Task Statistics --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-8">

                <div class="bg-white rounded-2xl border border-slate-200 p-6">
                    <p class="text-slate-500 text-sm">مهام معلقة</p>
                    <p class="text-2xl font-bold text-slate-700 mt-2">
                        {{ $pendingTasks }}
                    </p>
                </div>

                <div class="bg-white rounded-2xl border border-slate-200 p-6">
                    <p class="text-slate-500 text-sm">قيد التنفيذ</p>
                    <p class="text-2xl font-bold text-blue-600 mt-2">
                        {{ $inProgressTasks }}
                    </p>
                </div>

                <div class="bg-white rounded-2xl border border-slate-200 p-6">
                    <p class="text-slate-500 text-sm">مكتملة</p>
                    <p class="text-2xl font-bold text-green-600 mt-2">
                        {{ $completedTasks }}
                    </p>
                </div>

            </div>

            {{-- Two Columns --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                {{-- Upcoming Tasks --}}
                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">

                    <div class="flex items-center justify-between px-6 py-5 border-b border-slate-200">

                        <div>
                            <h2 class="text-lg font-bold text-slate-800">
                                المهام القادمة
                            </h2>

                            <p class="text-sm text-slate-500 mt-1">
                                أقرب مواعيد التسليم
                            </p>
                        </div>

                        <a href="{{ route('tasks.index') }}"
                           class="text-indigo-600 hover:text-indigo-800 text-sm font-semibold">
                            عرض الكل
                        </a>

                    </div>

                    <div class="divide-y divide-slate-100">

                        @forelse($upcomingTasks as $task)

                            <div class="px-6 py-5 hover:bg-slate-50 transition">

                                <div class="flex items-start justify-between gap-4">

                                    <div class="min-w-0">

                                        <a href="{{ route('tasks.show', $task) }}"
                                           class="font-semibold text-slate-800 hover:text-indigo-600">
                                            {{ $task->title }}
                                        </a>

                                        <p class="text-sm text-slate-500 mt-1">
                                            {{ $task->project?->name ?? 'بدون مشروع' }}
                                        </p>

                                    </div>

                                    <div class="text-left shrink-0">

                                        @if($task->due_date)
                                            <p class="text-sm font-semibold text-slate-700">
                                                {{ \Carbon\Carbon::parse($task->due_date)->format('Y-m-d') }}
                                            </p>
                                        @endif

                                        @if($task->priority === 'high')
                                            <span class="text-xs text-red-600">
                                                أولوية عالية
                                            </span>
                                        @elseif($task->priority === 'medium')
                                            <span class="text-xs text-yellow-600">
                                                أولوية متوسطة
                                            </span>
                                        @else
                                            <span class="text-xs text-green-600">
                                                أولوية منخفضة
                                            </span>
                                        @endif

                                    </div>

                                </div>

                            </div>

                        @empty

                            <div class="px-6 py-12 text-center">
                                <div class="text-4xl mb-3">📋</div>
                                <p class="text-slate-500">
                                    لا توجد مهام قادمة حاليًا
                                </p>
                            </div>

                        @endforelse

                    </div>

                </div>

                {{-- Latest Projects --}}
                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">

                    <div class="flex items-center justify-between px-6 py-5 border-b border-slate-200">

                        <div>
                            <h2 class="text-lg font-bold text-slate-800">
                                آخر المشاريع
                            </h2>

                            <p class="text-sm text-slate-500 mt-1">
                                أحدث المشاريع المضافة
                            </p>
                        </div>

                        <a href="{{ route('projects.index') }}"
                           class="text-indigo-600 hover:text-indigo-800 text-sm font-semibold">
                            عرض الكل
                        </a>

                    </div>

                    <div class="divide-y divide-slate-100">

                        @forelse($latestProjects as $project)

                            <div class="px-6 py-5 hover:bg-slate-50 transition">

                                <div class="flex items-center justify-between gap-4">

                                    <div class="min-w-0">

                                        <a href="{{ route('projects.show', $project) }}"
                                           class="font-semibold text-slate-800 hover:text-indigo-600">
                                            {{ $project->name }}
                                        </a>

                                        <p class="text-sm text-slate-500 mt-1">
                                            {{ $project->tasks_count }} مهام
                                        </p>

                                    </div>

                                    <div>

                                        @if($project->status === 'completed')

                                            <span class="px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700">
                                                مكتمل
                                            </span>

                                        @elseif($project->status === 'active')

                                            <span class="px-3 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-700">
                                                نشط
                                            </span>

                                        @else

                                            <span class="px-3 py-1 rounded-full text-xs font-semibold bg-slate-100 text-slate-700">
                                                {{ $project->status ?? 'غير محدد' }}
                                            </span>

                                        @endif

                                    </div>

                                </div>

                            </div>

                        @empty

                            <div class="px-6 py-12 text-center">

                                <div class="text-4xl mb-3">
                                    📁
                                </div>

                                <p class="text-slate-500">
                                    لا توجد مشاريع حتى الآن
                                </p>

                                <a href="{{ route('projects.create') }}"
                                   class="inline-block mt-4 text-indigo-600 font-semibold hover:text-indigo-800">
                                    + إضافة أول مشروع
                                </a>

                            </div>

                        @endforelse

                    </div>

                </div>

            </div>

            {{-- Quick Actions --}}
            <div class="mt-8 bg-white rounded-2xl border border-slate-200 shadow-sm p-6">

                <h2 class="text-lg font-bold text-slate-800 mb-5">
                    إجراءات سريعة
                </h2>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">

                    <a href="{{ route('projects.create') }}"
                       class="p-5 rounded-xl bg-indigo-50 hover:bg-indigo-100 transition">
                        <div class="text-2xl mb-2">📁</div>
                        <p class="font-bold text-slate-800">إنشاء مشروع</p>
                        <p class="text-sm text-slate-500 mt-1">إضافة مشروع جديد</p>
                    </a>

                    <a href="{{ route('tasks.create') }}"
                       class="p-5 rounded-xl bg-purple-50 hover:bg-purple-100 transition">
                        <div class="text-2xl mb-2">📋</div>
                        <p class="font-bold text-slate-800">إضافة مهمة</p>
                        <p class="text-sm text-slate-500 mt-1">إنشاء مهمة جديدة</p>
                    </a>

                    <a href="{{ route('projects.index') }}"
                       class="p-5 rounded-xl bg-blue-50 hover:bg-blue-100 transition">
                        <div class="text-2xl mb-2">📊</div>
                        <p class="font-bold text-slate-800">المشاريع</p>
                        <p class="text-sm text-slate-500 mt-1">إدارة المشاريع</p>
                    </a>

                    <a href="{{ route('tasks.index') }}"
                       class="p-5 rounded-xl bg-green-50 hover:bg-green-100 transition">
                        <div class="text-2xl mb-2">✅</div>
                        <p class="font-bold text-slate-800">المهام</p>
                        <p class="text-sm text-slate-500 mt-1">متابعة المهام</p>
                    </a>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>
