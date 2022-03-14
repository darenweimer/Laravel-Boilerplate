<template>
    <div class="border border-table rounded-lg bg-table font-default font-normal text-base text-table overflow-hidden">
        <div class="flex flex-row gap-4 items-center p-4">
            <div v-if="$slots['table-title']" class="flex-none font-title font-medium text-xl">
                <slot name="table-title">
                </slot>
            </div>

            <v-input type="search" class="grow border-table" v-model="search" placeholder="Search table..."/>

            <div v-if="$slots['table-actions']" class="flex-none">
                <slot name="table-actions">
                </slot>
            </div>
        </div>

        <div class="overflow-scroll">
            <table class="w-full table-auto border-collapse">
                <thead class="border-t border-b border-table bg-table-header font-semibold text-table-header text-sm uppercase">
                    <th v-for="column in columnsResolved" class="text-center px-4 py-2" :key="column._index">
                        <div class="inline-flex flex-row gap-2 items-center">
                            <div>
                                {{ column.label }}
                            </div>

                            <button v-if="column.sortable" class="focus:outline-none focus:ring-none" @click="sortColumn(column, $event)">
                                <div class="flex flex-col">
                                    <i class="fa-solid fa-caret-up" :class="{ 'opacity-40': columnSorting[column.id] !== 'asc' }"></i>
                                    <i class="fa-solid fa-caret-down" :class="{ 'opacity-40': columnSorting[column.id] !== 'desc' }"></i>
                                </div>
                            </button>
                        </div>
                    </th>
                </thead>

                <tbody v-if="rowsPaginated.length">
                    <tr v-for="row in rowsPaginated" class="border-t border-b border-table bg-table-row text-table-row" :class="{ 'hover:bg-table-highlight': highlight }" :key="row">
                        <td v-for="column in columnsResolved" class="px-4 py-2" :class="cellClasses(column)" :key="column._index">
                            <slot v-if="column.slot" :name="`row-${column.id}`" :row="rows[row]">
                            </slot>

                            <span v-else>
                                {{ rowsResolved[row][column.id] }}
                            </span>
                        </td>
                    </tr>
                </tbody>

                <tbody v-else>
                    <tr class="border-t border-b border-table bg-table-row text-table-row">
                        <td :colspan="columnsResolved.length" class="text-center align-middle px-4 py-2">
                            <i>
                                {{ emptyMessage }}
                            </i>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="flex flex-row gap-4 items-center p-4">
            <div class="grow">
                Showing rows

                <span class="font-medium">
                    {{ rangeStart }} - {{ rangeEnd }}
                </span>

                of

                <span class="font-medium">
                    {{ rowsFiltered.length }}
                </span>
            </div>

            <div class="flex-none border border-table rounded-md bg-table-page text-table-page overflow-hidden">
                <div class="grid grid-flow-col auto-cols-fr text-center">
                    <div class="border-r border-table px-2 py-1" :class="{ 'cursor-pointer': page > 1 }" @click="pageRewind(true)">
                        <i class="fa-solid fa-angle-double-left" :class="{ 'opacity-40': page <= 1 }"></i>
                    </div>

                    <div class="border-r border-table px-2 py-1" :class="{ 'cursor-pointer': page > 1 }" @click="pageRewind(false)">
                        <i class="fa-solid fa-caret-left" :class="{ 'opacity-40': page <= 1 }"></i>
                    </div>

                    <div v-for="pageNumber in shownPages" class="border-r border-table px-2 py-1" :class="{ 'bg-table-page-selected': pageNumber === page, 'cursor-pointer': pageNumber !== page }" @click="pageSelect(pageNumber)">
                        {{ pageNumber }}
                    </div>

                    <div class="border-r border-table px-2 py-1" :class="{ 'cursor-pointer': page < totalPages }" @click="pageAdvance(false)">
                        <i class="fa-solid fa-caret-right" :class="{ 'opacity-40': page >= totalPages }"></i>
                    </div>

                    <div class="px-2 py-1" :class="{ 'cursor-pointer': page < totalPages }" @click="pageAdvance(true)">
                        <i class="fa-solid fa-angle-double-right" :class="{ 'opacity-40': page >= totalPages }"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            columns: {
                type: Array,
                required: true,
            },
            rows: {
                type: Array,
                default: [],
            },
            hAlignment: {
                type: String,
                default: 'left',
            },
            vAlignment: {
                type: String,
                default: 'middle',
            },
            highlight: {
                type: Boolean,
                default: true,
            },
            sortable: {
                type: Boolean,
                default: true,
            },
            caseSensitive: {
                type: Boolean,
                default: false,
            },
            pagination: {
                type: Number,
                default: 10,
            },
            emptyMessage: {
                type: String,
                default: 'There are no rows in the table',
            },
        },
        data() {
            return {
                sorting: [],
                search: null,
                page: 1,
                perPage: this.pagination,
            };
        },
        computed: {
            columnsResolved() {
                let columns = [];

                for (const index in this.columns) {
                    let column = this.columns[index];

                    let resolved = {
                        _index: parseInt(index),
                        id: column.id ? column.id : null,
                        label: column.label ? column.label : null,
                        fixed: (column.fixed === undefined) ? false : (!!column.fixed),
                        data: (typeof column.data === 'function') ? column.data : null,
                        slot: (column.slot === undefined) ? false : (!!column.slot),
                        hAlignment: 'left',
                        vAlignment: 'middle',
                    };

                    if (resolved.slot) {
                        resolved.sortable = false;
                    } else if (column.sortable === undefined) {
                        resolved.sortable = !!this.sortable;
                    } else {
                        resolved.sortable = !!column.sortable;
                    }

                    let hAlignment = (column.hAlignment === undefined)
                        ? this.hAlignment.toLowerCase()
                        : column.hAlignment.toLowerCase();

                    if (['left', 'center', 'right'].includes(hAlignment)) {
                        resolved.hAlignment = hAlignment;
                    }

                    let vAlignment = (column.vAlignment === undefined)
                        ? this.vAlignment.toLowerCase()
                        : column.vAlignment.toLowerCase();

                    if (['top', 'middle', 'bottom'].includes(vAlignment)) {
                        resolved.vAlignment = vAlignment;
                    }

                    columns.push(resolved);
                }

                return columns;
            },
            rowsResolved() {
                let rows = [];

                for (const index in this.rows) {
                    let row = this.rows[index];

                    let resolved = {
                        _index: parseInt(index),
                    };

                    for (const column of this.columnsResolved) {
                        if (column.id && (!column.slot)) {
                            if (column.data) {
                                resolved[column.id] = column.data(row);
                            } else {
                                resolved[column.id] = column.id
                                    .split('.')
                                    .reduce(
                                        (a, b) => a[b], row
                                    );
                            }
                        }
                    }

                    rows.push(resolved);
                }

                return rows;
            },
            columnSorting() {
                let sorting = { };

                for (const column of this.columnsResolved) {
                    let index = this.sorting.findIndex(
                        (element) => element.id === column.id
                    );

                    sorting[column.id] = (index >= 0)
                        ? this.sorting[index].order
                        : null;
                }

                return sorting;
            },
            rowsSorted() {
                let rows = this.rowsResolved.slice().sort(
                    (a, b) => {
                        for (const sort of this.sorting) {
                            let comparison = 0;

                            if (a[sort.id] < b[sort.id]) {
                                comparison = -1;
                            } else if (a[sort.id] > b[sort.id]) {
                                comparison = 1;
                            }

                            if (comparison !== 0) {
                                return (sort.order === 'asc') ? comparison : (comparison * -1);
                            }
                        }

                        return 0;
                    }
                );

                let sorted = [];

                for (const row of rows) {
                    sorted.push(row._index);
                }

                return sorted;
            },
            rowsFiltered() {
                if (this.search) {
                    let search = this.search;

                    if (!this.caseSensitive) {
                        search = search.toLowerCase();
                    }

                    let rows = [];

                    for (const index of this.rowsSorted) {
                        let row = this.rowsResolved[index];

                        for (const column of this.columnsResolved) {
                            let value = row[column.id];

                            if ((value !== undefined) && (value !== null)) {
                                value = String(value);

                                if (!this.caseSensitive) {
                                    value = value.toLowerCase();
                                }

                                if (value.includes(search)) {
                                    rows.push(index);
                                    break;
                                }
                            }
                        }
                    }

                    return rows;
                } else {
                    return this.rowsSorted.slice();
                }
            },
            totalPages() {
                return Math.max(
                    Math.ceil(
                        this.rowsFiltered.length / this.perPage
                    ), 1
                );
            },
            shownPages() {
                let pages = [this.page];

                let increment = 1;

                do {
                    let page = this.page - increment;

                    if ((page >= 1) && (page <= this.totalPages)) {
                        pages.push(page);
                    }

                    page = this.page + increment;

                    if ((page >= 1) && (page <= this.totalPages)) {
                        pages.push(page);
                    }

                    increment++;
                } while (
                    (pages.length < 5) && (
                        ((this.page - increment) >= 1) ||
                        ((this.page + increment) <= this.totalPages)
                    )
                );

                pages.sort(
                    (a, b) => a - b
                );

                return pages;
            },
            rangeStart() {
                if (!this.rowsFiltered.length) {
                    return 0;
                }

                return ((this.page - 1) * this.perPage) + 1;
            },
            rangeEnd() {
                return Math.min(
                    ((this.page - 1) * this.perPage) + this.perPage,
                    this.rowsFiltered.length
                );
            },
            rowsPaginated() {
                if (this.page > this.totalPages) {
                    this.page = this.totalPages;
                }

                return this.rowsFiltered.slice(
                    (this.page - 1) * this.perPage, this.page * this.perPage
                );
            },
        },
        methods: {
            cellClasses(column) {
                let classes = [];

                if (column.fixed) {
                    classes.push('w-1 whitespace-nowrap');
                }

                classes.push(`text-${column.hAlignment}`);
                classes.push(`align-${column.vAlignment}`);

                return classes.join(' ');
            },
            sortColumn(column, event) {
                let sortOrder = null;

                let sortIndex = this.sorting.findIndex(
                    (element) => element.id === column.id
                );

                if (sortIndex >= 0) {
                    sortOrder = this.sorting[sortIndex].order;
                }

                if (event.shiftKey) {
                    if (sortIndex >= 0) {
                        this.sorting.splice(sortIndex, 1);
                    }
                } else {
                    this.sorting = [];
                }

                switch (sortOrder) {
                    case 'asc':
                        sortOrder = 'desc';
                        break;
                    case 'desc':
                        sortOrder = null;
                        break;
                    default:
                        sortOrder = 'asc';
                }

                if (sortOrder) {
                    this.sorting.push({
                        id: column.id,
                        order: sortOrder,
                    });
                }
            },
            pageRewind(toBeginning) {
                if (this.page > 1) {
                    if (toBeginning) {
                        this.page = 1;
                    } else {
                        this.page--;
                    }
                }
            },
            pageSelect(page) {
                if ((page >= 1) && (page <= this.totalPages)) {
                    this.page = page;
                }
            },
            pageAdvance(toEnd) {
                if (this.page < this.totalPages) {
                    if (toEnd) {
                        this.page = this.totalPages;
                    } else {
                        this.page++;
                    }
                }
            },
        },
    };
</script>
