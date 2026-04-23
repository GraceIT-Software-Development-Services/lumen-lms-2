<div class="space-y-6">

    {{-- KPI CARDS --}}
    <div class="grid grid-cols-1 gap-4 md:grid-cols-3">

        {{-- Learners --}}
        <div class="relative overflow-hidden rounded-3xl border border-blue-100 bg-gradient-to-br from-white to-blue-50/40 p-5 shadow-sm transition hover:-translate-y-0.5 hover:shadow-lg hover:shadow-blue-100/60 dark:border-blue-900/30 dark:from-gray-900 dark:to-blue-950/20" style="border-top: 3px solid #3b82f6">
            {{-- Decorative blobs --}}
            <div class="pointer-events-none absolute -right-4 -top-4 h-24 w-24 rounded-full bg-blue-100/60 blur-2xl dark:bg-blue-500/10"></div>
            <div class="pointer-events-none absolute -bottom-6 -left-6 h-20 w-20 rounded-full bg-blue-50/80 blur-xl dark:bg-blue-900/20"></div>

            <div wire:loading wire:target="render" class="absolute inset-0 z-10 flex items-center justify-center rounded-3xl bg-white/80 backdrop-blur-sm dark:bg-gray-900/80">
                <div class="space-y-3 text-center">
                    <div class="mx-auto h-10 w-10 animate-pulse rounded-2xl bg-gray-200 dark:bg-gray-700"></div>
                    <div class="mx-auto h-3 w-24 animate-pulse rounded bg-gray-200 dark:bg-gray-700"></div>
                    <div class="mx-auto h-8 w-16 animate-pulse rounded bg-gray-200 dark:bg-gray-700"></div>
                </div>
            </div>

            <div wire:loading.remove wire:target="render">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-[11px] font-bold uppercase tracking-[0.2em] text-blue-500 dark:text-blue-400">Learners</p>
                        <h3 class="mt-2 text-4xl font-extrabold tracking-tight text-gray-900 dark:text-white">
                            {{ number_format($totalLearners ?? 0) }}
                        </h3>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Total registered learners</p>
                    </div>
                    <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-blue-500 text-white shadow-lg shadow-blue-200 dark:shadow-blue-900/40">
                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 10a4 4 0 100-8 4 4 0 000 8zm-7 8a7 7 0 1114 0H3z" />
                        </svg>
                    </div>
                </div>
                <div class="mt-5 h-1.5 w-full overflow-hidden rounded-full bg-blue-100 dark:bg-blue-900/30">
                    <div class="h-full w-3/4 rounded-full bg-gradient-to-r from-blue-400 to-blue-600 shadow-sm shadow-blue-300/60" style="transition: width 1s ease"></div>
                </div>
            </div>
        </div>

        {{-- Courses --}}
        <div class="relative overflow-hidden rounded-3xl border border-emerald-100 bg-gradient-to-br from-white to-emerald-50/40 p-5 shadow-sm transition hover:-translate-y-0.5 hover:shadow-lg hover:shadow-emerald-100/60 dark:border-emerald-900/30 dark:from-gray-900 dark:to-emerald-950/20" style="border-top: 3px solid #10b981">
            <div class="pointer-events-none absolute -right-4 -top-4 h-24 w-24 rounded-full bg-emerald-100/60 blur-2xl dark:bg-emerald-500/10"></div>
            <div class="pointer-events-none absolute -bottom-6 -left-6 h-20 w-20 rounded-full bg-emerald-50/80 blur-xl dark:bg-emerald-900/20"></div>

            <div wire:loading wire:target="render" class="absolute inset-0 z-10 flex items-center justify-center rounded-3xl bg-white/80 backdrop-blur-sm dark:bg-gray-900/80">
                <div class="space-y-3 text-center">
                    <div class="mx-auto h-10 w-10 animate-pulse rounded-2xl bg-gray-200 dark:bg-gray-700"></div>
                    <div class="mx-auto h-3 w-24 animate-pulse rounded bg-gray-200 dark:bg-gray-700"></div>
                    <div class="mx-auto h-8 w-16 animate-pulse rounded bg-gray-200 dark:bg-gray-700"></div>
                </div>
            </div>

            <div wire:loading.remove wire:target="render">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-[11px] font-bold uppercase tracking-[0.2em] text-emerald-500 dark:text-emerald-400">Courses</p>
                        <h3 class="mt-2 text-4xl font-extrabold tracking-tight text-gray-900 dark:text-white">
                            {{ number_format($totalCourses ?? 0) }}
                        </h3>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Total registered courses</p>
                    </div>
                    <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-emerald-500 text-white shadow-lg shadow-emerald-200 dark:shadow-emerald-900/40">
                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10.707 1.293a1 1 0 00-1.414 0l-8 8a1 1 0 001.414 1.414L3 10.414V18a2 2 0 002 2h3a1 1 0 001-1v-4h2v4a1 1 0 001 1h3a2 2 0 002-2v-7.586l.293.293a1 1 0 001.414-1.414l-8-8z" />
                        </svg>
                    </div>
                </div>
                <div class="mt-5 h-1.5 w-full overflow-hidden rounded-full bg-emerald-100 dark:bg-emerald-900/30">
                    <div class="h-full w-2/3 rounded-full bg-gradient-to-r from-emerald-400 to-emerald-600 shadow-sm shadow-emerald-300/60" style="transition: width 1s ease"></div>
                </div>
            </div>
        </div>

        {{-- Trainings --}}
        <div class="relative overflow-hidden rounded-3xl border border-violet-100 bg-gradient-to-br from-white to-violet-50/40 p-5 shadow-sm transition hover:-translate-y-0.5 hover:shadow-lg hover:shadow-violet-100/60 dark:border-violet-900/30 dark:from-gray-900 dark:to-violet-950/20" style="border-top: 3px solid #8b5cf6">
            <div class="pointer-events-none absolute -right-4 -top-4 h-24 w-24 rounded-full bg-violet-100/60 blur-2xl dark:bg-violet-500/10"></div>
            <div class="pointer-events-none absolute -bottom-6 -left-6 h-20 w-20 rounded-full bg-violet-50/80 blur-xl dark:bg-violet-900/20"></div>

            <div wire:loading wire:target="render" class="absolute inset-0 z-10 flex items-center justify-center rounded-3xl bg-white/80 backdrop-blur-sm dark:bg-gray-900/80">
                <div class="space-y-3 text-center">
                    <div class="mx-auto h-10 w-10 animate-pulse rounded-2xl bg-gray-200 dark:bg-gray-700"></div>
                    <div class="mx-auto h-3 w-24 animate-pulse rounded bg-gray-200 dark:bg-gray-700"></div>
                    <div class="mx-auto h-8 w-16 animate-pulse rounded bg-gray-200 dark:bg-gray-700"></div>
                </div>
            </div>

            <div wire:loading.remove wire:target="render">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-[11px] font-bold uppercase tracking-[0.2em] text-violet-500 dark:text-violet-400">Trainings</p>
                        <h3 class="mt-2 text-4xl font-extrabold tracking-tight text-gray-900 dark:text-white">
                            {{ number_format($totalTrainings ?? 0) }}
                        </h3>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Ongoing training batches</p>
                    </div>
                    <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-violet-500 text-white shadow-lg shadow-violet-200 dark:shadow-violet-900/40">
                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 12c1.657 0 3-1.79 3-4s-1.343-4-3-4-3 1.79-3 4 1.343 4 3 4zm0 2c-2.33 0-7 1.17-7 3.5V20h14v-2.5c0-2.33-4.67-3.5-7-3.5zm7-6c0 1.657-1.343 3-3 3s-3-1.343-3-3 1.343-3 3-3 3 1.343 3 3zm-1 9v-1.25c0-1.25-2.5-2.25-4-2.25h-.59c.36.53.59 1.14.59 1.75V20h4zm-12 0v-1.75c0-.61.23-1.22.59-1.75H6c-1.5 0-4 .99-4 2.25V20h4z" />
                        </svg>
                    </div>
                </div>
                <div class="mt-5 h-1.5 w-full overflow-hidden rounded-full bg-violet-100 dark:bg-violet-900/30">
                    <div class="h-full w-1/2 rounded-full bg-gradient-to-r from-violet-400 to-violet-600 shadow-sm shadow-violet-300/60" style="transition: width 1s ease"></div>
                </div>
            </div>
        </div>
    </div>

    @if (auth()->user()->hasRole('Director'))
    {{-- MAIN ANALYTICS --}}
    <div class="grid grid-cols-1 gap-6 xl:grid-cols-3">

        {{-- Monthly Applications Chart --}}
        <div class="xl:col-span-2 overflow-hidden rounded-3xl border border-gray-200 bg-white shadow-sm dark:border-gray-800 dark:bg-gray-900">
            <div class="border-b border-gray-100 px-6 py-5 dark:border-gray-800">
                <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                    <div class="flex items-center gap-3">
                        <div>
                            <div class="flex items-center gap-2">
                                <h3 class="text-base font-bold text-gray-900 dark:text-white">Monthly Applications</h3>
                                <span class="inline-flex items-center gap-1 rounded-full bg-emerald-50 px-2 py-0.5 text-[10px] font-bold uppercase tracking-wider text-emerald-600 dark:bg-emerald-500/10 dark:text-emerald-400">
                                    <span class="h-1.5 w-1.5 animate-pulse rounded-full bg-emerald-500"></span>
                                    Live
                                </span>
                            </div>
                            <p class="mt-0.5 text-sm text-gray-500 dark:text-gray-400">
                                Learner applications overview for {{ $selectedYear }}
                            </p>
                        </div>
                    </div>
                    <select
                        wire:model.live="selectedYear"
                        class="w-full rounded-xl border border-gray-200 bg-white px-3 py-2 text-sm font-medium text-gray-700 shadow-sm focus:border-indigo-400 focus:outline-none focus:ring-4 focus:ring-indigo-100 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-200 sm:w-auto">
                        @foreach($availableYears as $year)
                        <option value="{{ $year }}">{{ $year }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            {{-- Stat mini-cards --}}
            <div class="grid grid-cols-3 divide-x divide-gray-100 border-b border-gray-100 dark:divide-gray-800 dark:border-gray-800">
                <div class="px-5 py-4">
                    <p class="text-[10px] font-bold uppercase tracking-wider text-blue-500 dark:text-blue-400">Total</p>
                    <p class="mt-1.5 text-2xl font-extrabold text-blue-600 dark:text-blue-400">{{ number_format($totalApplications) }}</p>
                    <p class="mt-0.5 text-xs text-gray-400">applications</p>
                </div>
                <div class="px-5 py-4">
                    <p class="text-[10px] font-bold uppercase tracking-wider text-emerald-500 dark:text-emerald-400">Peak</p>
                    <p class="mt-1.5 text-2xl font-extrabold text-emerald-600 dark:text-emerald-400">{{ $peakMonth }}</p>
                    <p class="mt-0.5 text-xs text-gray-400">busiest month</p>
                </div>
                <div class="px-5 py-4">
                    <p class="text-[10px] font-bold uppercase tracking-wider text-violet-500 dark:text-violet-400">Avg / mo</p>
                    <p class="mt-1.5 text-2xl font-extrabold text-violet-600 dark:text-violet-400">
                        {{ $totalApplications > 0 ? number_format(round($totalApplications / 12, 1)) : 0 }}
                    </p>
                    <p class="mt-0.5 text-xs text-gray-400">per month</p>
                </div>
            </div>

            <div class="p-5">
                <div class="h-[340px]">
                    <canvas wire:ignore id="monthlyApplicationChart"></canvas>
                </div>
            </div>
        </div>

        {{-- Top Courses --}}
        <div class="overflow-hidden rounded-3xl border border-gray-200 bg-white shadow-sm dark:border-gray-800 dark:bg-gray-900" style="border-top: 3px solid #f59e0b">
            <div class="border-b border-gray-100 px-6 py-5 dark:border-gray-800">
                <h3 class="text-base font-bold text-gray-900 dark:text-white">Most Applied Courses</h3>
                <p class="mt-0.5 text-sm text-gray-500 dark:text-gray-400">
                    Top courses by count — {{ $selectedYear }}
                </p>
            </div>

            <div class="space-y-2.5 p-5">
                @if(count($topCoursesData['series']) > 0)
                @php
                $maxVal = max($topCoursesData['series']) ?: 1;
                @endphp
                @foreach(array_slice(array_keys($topCoursesData['series']), 0, 3) as $i)
                @php
                $medals = [
                0 => ['ring' => 'ring-yellow-200 dark:ring-yellow-700/40', 'bg' => 'bg-yellow-50 dark:bg-yellow-500/10', 'badge' => 'bg-yellow-100 text-yellow-700 dark:bg-yellow-500/20 dark:text-yellow-300', 'bar' => 'bg-gradient-to-r from-yellow-300 to-yellow-500'],
                1 => ['ring' => 'ring-slate-200 dark:ring-slate-600/40', 'bg' => 'bg-slate-50 dark:bg-slate-800/60', 'badge' => 'bg-slate-200 text-slate-600 dark:bg-slate-700 dark:text-slate-300', 'bar' => 'bg-gradient-to-r from-slate-300 to-slate-500'],
                2 => ['ring' => 'ring-orange-200 dark:ring-orange-700/40', 'bg' => 'bg-orange-50 dark:bg-orange-500/10', 'badge' => 'bg-orange-100 text-orange-700 dark:bg-orange-500/20 dark:text-orange-300', 'bar' => 'bg-gradient-to-r from-orange-300 to-orange-500'],
                ];
                $m = $medals[$i] ?? $medals[2];
                $pct = round(($topCoursesData['series'][$i] ?? 0) / $maxVal * 100);
                @endphp
                <div class="rounded-2xl ring-1 {{ $m['ring'] }} {{ $m['bg'] }} px-4 py-3">
                    <div class="flex items-center gap-3">
                        <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl text-xs font-black {{ $m['badge'] }}">
                            #{{ $i + 1 }}
                        </div>
                        <div class="min-w-0 flex-1">
                            <p class="truncate text-sm font-semibold text-gray-800 dark:text-gray-100">
                                {{ $topCoursesData['names'][$i] ?? '' }}
                            </p>
                            <p class="mt-0.5 text-xs text-gray-500 dark:text-gray-400">
                                {{ number_format($topCoursesData['series'][$i] ?? 0) }} applications
                            </p>
                        </div>
                        <span class="text-xs font-bold text-gray-400">{{ $pct }}%</span>
                    </div>
                    <div class="mt-2.5 h-1 w-full overflow-hidden rounded-full bg-black/5 dark:bg-white/10">
                        <div class="h-full rounded-full {{ $m['bar'] }}" style="width: {{ $pct }}%; transition: width 0.8s ease"></div>
                    </div>
                </div>
                @endforeach

                <div class="pt-3">
                    <div class="h-[240px]">
                        <canvas wire:ignore id="topCoursesChart"></canvas>
                    </div>
                </div>
                @else
                <div class="flex min-h-[260px] flex-col items-center justify-center text-center">
                    <div class="mb-3 flex h-14 w-14 items-center justify-center rounded-2xl bg-gray-100 text-gray-400 dark:bg-gray-800 dark:text-gray-500">
                        <svg class="h-7 w-7" fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 17v-6m3 6V7m3 10v-3m3 7H6a2 2 0 01-2-2V5a2 2 0 012-2h12a2 2 0 012 2v14a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <p class="text-sm font-semibold text-gray-700 dark:text-gray-200">No course data available</p>
                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Top applied courses will appear here once applications are recorded.</p>
                </div>
                @endif
            </div>
        </div>
    </div>
    @endif

    @once
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @endonce

    <script>
        (function() {
            let monthlyChart = null;
            let topCoursesChart = null;

            const monthLabels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

            function destroyCharts() {
                if (monthlyChart) {
                    monthlyChart.destroy();
                    monthlyChart = null;
                }
                if (topCoursesChart) {
                    topCoursesChart.destroy();
                    topCoursesChart = null;
                }
            }

            function buildGradient(ctx, chartArea, colorStart, colorEnd) {
                const gradient = ctx.createLinearGradient(0, chartArea.top, 0, chartArea.bottom);
                gradient.addColorStop(0, colorStart);
                gradient.addColorStop(1, colorEnd);
                return gradient;
            }

            function renderMonthlyChart(data) {
                const el = document.getElementById('monthlyApplicationChart');
                if (!el || typeof Chart === 'undefined') return;

                monthlyChart = new Chart(el, {
                    type: 'bar',
                    data: {
                        labels: monthLabels,
                        datasets: [{
                            label: 'Applications',
                            data: data,
                            backgroundColor: function(context) {
                                const chart = context.chart;
                                const {
                                    ctx,
                                    chartArea
                                } = chart;
                                if (!chartArea) return '#6366f1';
                                return buildGradient(ctx, chartArea, '#818cf8', '#4f46e5');
                            },
                            borderRadius: 10,
                            borderSkipped: false,
                            maxBarThickness: 38,
                            hoverBackgroundColor: function(context) {
                                const chart = context.chart;
                                const {
                                    ctx,
                                    chartArea
                                } = chart;
                                if (!chartArea) return '#a5b4fc';
                                return buildGradient(ctx, chartArea, '#a5b4fc', '#6366f1');
                            },
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        animation: {
                            duration: 600,
                            easing: 'easeOutQuart'
                        },
                        plugins: {
                            legend: {
                                display: false
                            },
                            tooltip: {
                                backgroundColor: '#1e1b4b',
                                titleColor: '#a5b4fc',
                                bodyColor: '#e0e7ff',
                                padding: 12,
                                cornerRadius: 10,
                                displayColors: false,
                                callbacks: {
                                    title: (items) => monthLabels[items[0].dataIndex],
                                    label: (ctx) => `  ${ctx.parsed.y} application(s)`,
                                }
                            }
                        },
                        scales: {
                            x: {
                                grid: {
                                    display: false
                                },
                                border: {
                                    display: false
                                },
                                ticks: {
                                    color: '#9ca3af',
                                    font: {
                                        size: 11,
                                        weight: '500'
                                    }
                                }
                            },
                            y: {
                                beginAtZero: true,
                                border: {
                                    display: false,
                                    dash: [4, 4]
                                },
                                grid: {
                                    color: '#f3f4f6'
                                },
                                ticks: {
                                    precision: 0,
                                    color: '#9ca3af',
                                    font: {
                                        size: 11
                                    }
                                }
                            }
                        }
                    }
                });
            }

            function renderTopCoursesChart(labels, data) {
                const el = document.getElementById('topCoursesChart');
                if (!el || typeof Chart === 'undefined' || !labels.length) return;

                const total = data.reduce((a, b) => a + b, 0);

                const centerTextPlugin = {
                    id: 'centerText',
                    beforeDraw(chart) {
                        const {
                            width,
                            height,
                            ctx
                        } = chart;
                        ctx.save();
                        ctx.textAlign = 'center';
                        ctx.textBaseline = 'middle';
                        const cx = width / 2;
                        const cy = height / 2 - 10;
                        ctx.fillStyle = '#6b7280';
                        ctx.font = '11px system-ui, sans-serif';
                        ctx.fillText('Total', cx, cy - 12);
                        ctx.fillStyle = '#111827';
                        ctx.font = 'bold 22px system-ui, sans-serif';
                        ctx.fillText(total.toLocaleString(), cx, cy + 10);
                        ctx.restore();
                    }
                };

                topCoursesChart = new Chart(el, {
                    type: 'doughnut',
                    plugins: [centerTextPlugin],
                    data: {
                        labels: labels,
                        datasets: [{
                            data: data,
                            backgroundColor: ['#f59e0b', '#6366f1', '#10b981', '#ef4444', '#8b5cf6'],
                            borderWidth: 3,
                            borderColor: '#ffffff',
                            hoverOffset: 8,
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        cutout: '72%',
                        animation: {
                            animateRotate: true,
                            duration: 700,
                            easing: 'easeOutQuart'
                        },
                        plugins: {
                            legend: {
                                position: 'bottom',
                                labels: {
                                    boxWidth: 10,
                                    boxHeight: 10,
                                    borderRadius: 5,
                                    color: '#6b7280',
                                    padding: 14,
                                    font: {
                                        size: 11
                                    }
                                }
                            },
                            tooltip: {
                                backgroundColor: '#1e1b4b',
                                titleColor: '#a5b4fc',
                                bodyColor: '#e0e7ff',
                                padding: 12,
                                cornerRadius: 10,
                                displayColors: true,
                                callbacks: {
                                    label: (ctx) => `  ${ctx.label}: ${ctx.parsed} application(s)`,
                                }
                            }
                        }
                    }
                });
            }

            function renderCharts(monthlyData, topNames, topSeries) {
                destroyCharts();
                renderMonthlyChart(monthlyData);
                renderTopCoursesChart(topNames, topSeries);
            }

            const initData = {
                monthly: @json($monthlyData),
                topNames: @json($topCoursesData['names'] ?? []),
                topSeries: @json($topCoursesData['series'] ?? []),
            };

            function init() {
                renderCharts(initData.monthly, initData.topNames, initData.topSeries);
            }

            document.addEventListener('DOMContentLoaded', init);
            document.addEventListener('livewire:navigated', init);

            window.addEventListener('chartDataUpdated', function(event) {
                renderCharts(
                    event.detail.data ?? initData.monthly,
                    event.detail.topCourseNames ?? initData.topNames,
                    event.detail.topCourseSeries ?? initData.topSeries
                );
            });
        })();
    </script>
</div>