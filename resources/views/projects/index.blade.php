<x-app-layout>

    <div class="min-h-screen bg-slate-100" dir="rtl">

        {{-- Page Header --}}
        <div class="border-b border-slate-200 bg-white">
            <div class="mx-auto max-w-7xl px-6 py-7">

                <div class="flex flex-col gap-5 sm:flex-row sm:items-center sm:justify-between">

                    <div>
                        <div class="flex items-center gap-3">

                            <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-indigo-600 text-2xl text-white shadow-lg">
                                📁
                            </div>

                            <div>
                                <h1 class="text-2xl font-bold text-slate-800">
                                    المشاريع
                                </h1>

                                <p class="mt-1 text-sm text-slate-500">
                                    إدارة ومتابعة جميع مشاريعك من مكان واحد
                                </p>
                            </div>

                        </div>
                    </div>

                    <a href="{{ route('projects.create') }}"
                       class="inline-flex items-center justify-center gap-2 rounded-xl bg-indigo-600 px-5 py-3 text-sm font-bold text-white shadow-md transition hover:bg-indigo-700 hover:shadow-lg">

                        <span class="text-xl">+</span>
                        إنشاء مشروع جديد

                    </a>

                </div>

            </div>
        </div>


        {{-- Main Content --}}
        <main class="mx-auto max-w-7xl px-6 py-8">

            {{-- Success Message --}}
            @if(session('success'))

                <div class="mb-6 flex items-center gap-3 rounded-2xl border border-emerald-200 bg-emerald-50 px-5 py-4 text-emerald-700">

                    <div class="flex h-9 w-9 items-center justify-center rounded-full bg-emerald-100">
                        ✓
                    </div>

                    <p class="text-sm font-semibold">
                        {{ session('success') }}
                    </p>

                </div>

            @endif


            {{-- Statistics --}}
            <div class="mb-8 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4">

                {{-- Total --}}
                <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-md">

                    <div class="flex items-center justify-between">

                        <div>
                            <p class="text-sm font-medium text-slate-500">
                                إجمالي المشاريع
                            </p>

                            <p class="mt-2 text-3xl font-bold text-slate-800">
                                {{ $projects->total() }}
                            </p>

                            <p class="mt-2 text-xs text-slate-400">
                                جميع المشاريع
                            </p>
                        </div>

                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-indigo-50 text-xl">
                            📊
                        </div>

                    </div>

                </div>


                {{-- In Progress --}}
                <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-md">

                    <div class="flex items-center justify-between">

                        <div>
                            <p class="text-sm font-medium text-slate-500">
                                قيد التنفيذ
                            </p>

                            <p class="mt-2 text-3xl font-bold text-blue-600">
                                {{ $projects->where('status', 'in_progress')->count() }}
                            </p>

                            <p class="mt-2 text-xs text-slate-400">
                                مشاريع نشطة
                            </p>
                        </div>

                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-blue-50 text-xl">
                            🚀
                        </div>

                    </div>

                </div>


                {{-- Completed --}}
                <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-md">

                    <div class="flex items-center justify-between">

                        <div>
                            <p class="text-sm font-medium text-slate-500">
                                مكتملة
                            </p>

                            <p class="mt-2 text-3xl font-bold text-emerald-600">
                                {{ $projects->where('status', 'completed')->count() }}
                            </p>

                            <p class="mt-2 text-xs text-slate-400">
                                مشاريع منتهية
                            </p>
                        </div>

                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-emerald-50 text-xl">
                            ✓
                        </div>

                    </div>

                </div>


                {{-- Planning --}}
                <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-md">

                    <div class="flex items-center justify-between">

                        <div>
                            <p class="text-sm font-medium text-slate-500">
                                قيد التخطيط
                            </p>

                            <p class="mt-2 text-3xl font-bold text-amber-600">
                                {{ $projects->where('status', 'planning')->count() }}
                            </p>

                            <p class="mt-2 text-xs text-slate-400">
                                مشاريع جديدة
                            </p>
                        </div>

                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-amber-50 text-xl">
                            📝
                        </div>

                    </div>

                </div>

            </div>


            {{-- Projects Card --}}
            <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

                {{-- Card Header --}}
                <div class="flex flex-col gap-3 border-b border-slate-200 px-6 py-5 sm:flex-row sm:items-center sm:justify-between">

                    <div>
                        <h2 class="text-lg font-bold text-slate-800">
                            جميع المشاريع
                        </h2>

                        <p class="mt-1 text-sm text-slate-500">
                            قائمة المشاريع الموجودة في النظام
                        </p>
                    </div>

                    <div class="rounded-lg bg-slate-100 px-3 py-2 text-xs font-semibold text-slate-600">
                        {{ $projects->total() }} مشروع
                    </div>

                </div>


                @if($projects->count())

                    {{-- Table --}}
                    <div class="overflow-x-auto">

                        <table class="w-full">

                            <thead class="border-b border-slate-200 bg-slate-50">

                                <tr>

                                    <th class="px-6 py-4 text-right text-xs font-bold text-slate-500">
                                        المشروع
                                    </th>

                                    <th class="px-6 py-4 text-right text-xs font-bold text-slate-500">
                                        المهام
                                    </th>

                                    <th class="px-6 py-4 text-right text-xs font-bold text-slate-500">
                                        الحالة
                                    </th>

                                    <th class="px-6 py-4 text-right text-xs font-bold text-slate-500">
                                        تاريخ البداية
                                    </th>

                                    <th class="px-6 py-4 text-right text-xs font-bold text-slate-500">
                                        موعد الانتهاء
                                    </th>

                                    <th class="px-6 py-4 text-right text-xs font-bold text-slate-500">
                                        الإجراءات
                                    </th>

                                </tr>

                            </thead>


                            <tbody class="divide-y divide-slate-100">

                                @foreach($projects as $project)

                                    <tr class="transition hover:bg-slate-50">

                                        {{-- Project Name --}}
                                        <td class="px-6 py-5">

                                            <div class="flex items-center gap-3">

                                                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-indigo-50 text-lg">
                                                    📁
                                                </div>

                                                <div>

                                                    <p class="font-bold text-slate-800">
                                                        {{ $project->name }}
                                                    </p>

                                                    @if($project->description)

                                                        <p class="mt-1 max-w-xs truncate text-xs text-slate-400">
                                                            {{ $project->description }}
                                                        </p>

                                                    @else

                                                        <p class="mt-1 text-xs text-slate-400">
                                                            بدون وصف
                                                        </p>

                                                    @endif

                                                </div>

                                            </div>

                                        </td>


                                        {{-- Tasks --}}
                                        <td class="px-6 py-5">

                                            <span class="inline-flex items-center rounded-lg bg-slate-100 px-3 py-2 text-xs font-bold text-slate-600">

                                                {{ $project->tasks_count }}

                                                <span class="mr-1">
                                                    مهام
                                                </span>

                                            </span>

                                        </td>


                                        {{-- Status --}}
                                        <td class="px-6 py-5">

                                            @if($project->status === 'planning')

                                                <span class="inline-flex items-center gap-2 rounded-full bg-amber-50 px-3 py-2 text-xs font-bold text-amber-700">

                                                    <span class="h-2 w-2 rounded-full bg-amber-500"></span>

                                                    قيد التخطيط

                                                </span>

                                            @elseif($project->status === 'in_progress')

                                                <span class="inline-flex items-center gap-2 rounded-full bg-blue-50 px-3 py-2 text-xs font-bold text-blue-700">

                                                    <span class="h-2 w-2 rounded-full bg-blue-500"></span>

                                                    قيد التنفيذ

                                                </span>

                                            @elseif($project->status === 'completed')

                                                <span class="inline-flex items-center gap-2 rounded-full bg-emerald-50 px-3 py-2 text-xs font-bold text-emerald-700">

                                                    <span class="h-2 w-2 rounded-full bg-emerald-500"></span>

                                                    مكتمل

                                                </span>

                                            @else

                                                <span class="inline-flex items-center gap-2 rounded-full bg-slate-100 px-3 py-2 text-xs font-bold text-slate-600">

                                                    <span class="h-2 w-2 rounded-full bg-slate-500"></span>

                                                    {{ $project->status }}

                                                </span>

                                            @endif

                                        </td>


                                        {{-- Start Date --}}
                                        <td class="px-6 py-5 text-sm text-slate-600">

                                            @if($project->start_date)

                                                {{ \Carbon\Carbon::parse($project->start_date)->format('Y-m-d') }}

                                            @else

                                                <span class="text-slate-400">
                                                    غير محدد
                                                </span>

                                            @endif

                                        </td>


                                        {{-- End Date --}}
                                        <td class="px-6 py-5 text-sm text-slate-600">

                                            @if($project->end_date)

                                                {{ \Carbon\Carbon::parse($project->end_date)->format('Y-m-d') }}

                                            @else

                                                <span class="text-slate-400">
                                                    غير محدد
                                                </span>

                                            @endif

                                        </td>


                                        {{-- Actions --}}
                                        <td class="px-6 py-5">

                                            <div class="flex items-center gap-2">

                                                {{-- View --}}
                                                <a href="{{ route('projects.show', $project) }}"
                                                   class="rounded-lg bg-slate-100 px-3 py-2 text-xs font-bold text-slate-600 transition hover:bg-slate-200">

                                                    عرض

                                                </a>


                                                {{-- Edit --}}
                                                <a href="{{ route('projects.edit', $project) }}"
                                                   class="rounded-lg bg-indigo-50 px-3 py-2 text-xs font-bold text-indigo-600 transition hover:bg-indigo-100">

                                                    تعديل

                                                </a>


                                                {{-- Delete --}}
                                                <form action="{{ route('projects.destroy', $project) }}"
                                                      method="POST"
                                                      onsubmit="return confirm('هل أنت متأكد من حذف هذا المشروع؟')">

                                                    @csrf

                                                    @method('DELETE')

                                                    <button type="submit"
                                                            class="rounded-lg bg-red-50 px-3 py-2 text-xs font-bold text-red-600 transition hover:bg-red-100">

                                                        حذف

                                                    </button>

                                                </form>

                                            </div>

                                        </td>

                                    </tr>

                                @endforeach

                            </tbody>

                        </table>

                    </div>


                    {{-- Pagination --}}
                    @if($projects->hasPages())

                        <div class="border-t border-slate-200 px-6 py-5">
                            {{ $projects->links() }}
                        </div>

                    @endif


                @else

                    {{-- Empty State --}}
                    <div class="px-6 py-20 text-center">

                        <div class="mx-auto flex h-20 w-20 items-center justify-center rounded-3xl bg-indigo-50 text-4xl">
                            📁
                        </div>

                        <h3 class="mt-6 text-xl font-bold text-slate-800">
                            لا توجد مشاريع حتى الآن
                        </h3>

                        <p class="mx-auto mt-2 max-w-md text-sm leading-6 text-slate-500">
                            ابدأ بإنشاء أول مشروع لك، وبعدها يمكنك إضافة المهام ومتابعة تقدم المشروع.
                        </p>

                        <a href="{{ route('projects.create') }}"
                           class="mt-6 inline-flex items-center gap-2 rounded-xl bg-indigo-600 px-6 py-3 text-sm font-bold text-white shadow-md transition hover:bg-indigo-700">

                            <span class="text-lg">+</span>

                            إنشاء أول مشروع

                        </a>

                    </div>

                @endif

            </div>

        </main>

    </div>

</x-app-layout>