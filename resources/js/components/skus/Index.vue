<template>
    <div>
        <ol class="breadcrumb">
            <li class="breadcrumb-item active">Skus</li>
            <li class="breadcrumb-menu">
                <a class="btn btn-outline-success text-success" href="/skus/create">New sku</a>
            </li>
        </ol>
        <div class="container">
            <div class="card-body px-0">
                <div class="row justify-content-between">
                    <div class="col-7 col-md-5">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                <span class="input-group-text" @click="filter">
                  <i class="fas fa-search"></i>
                </span>
                            </div>
                            <input type="text" class="form-control" placeholder="Seach" v-model.trim="filters.search" @keyup.enter="filter">
                        </div>
                    </div>
                    <div class="col-auto">
                        <multiselect
                                v-model="filters.pagination.per_page"
                                :options="[25,50,100,200]"
                                :searchable="false"
                                :show-labels="false"
                                :allow-empty="false"
                                @select="changeSize"
                                placeholder="Search">
                        </multiselect>
                    </div>
                </div>
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th class="d-none d-sm-table-cell">
                            <a href="#" class="text-dark" @click.prevent="sort('id')">ID</a>
                            <i class="ml-1 fas"
                               :class="{'fa-long-arrow-alt-down': filters.orderBy.column == 'id' && filters.orderBy.direction == 'asc', 'fa-long-arrow-alt-up': filters.orderBy.column == 'id' && filters.orderBy.direction == 'desc'}"></i>
                        </th>
                        <th>
                            <a href="#" class="text-dark" @click.prevent="sort('name')">Name</a>
                            <i class="ml-1 fas"
                               :class="{'fa-long-arrow-alt-down': filters.orderBy.column == 'name' && filters.orderBy.direction == 'asc', 'fa-long-arrow-alt-up': filters.orderBy.column == 'name' && filters.orderBy.direction == 'desc'}"></i>
                        </th>
                        <th>
                            <a href="#" class="text-dark" @click.prevent="sort('desc')">Description</a>
                            <i class="ml-1 fas"
                               :class="{'fa-long-arrow-alt-down': filters.orderBy.column == 'desc' && filters.orderBy.direction == 'asc', 'fa-long-arrow-alt-up': filters.orderBy.column == 'desc' && filters.orderBy.direction == 'desc'}"></i>
                        </th>
                        <th class="d-none d-sm-table-cell">
                            <a href="#" class="text-dark" @click.prevent="sort('code')">Code</a>
                            <i class="ml-1 fas"
                               :class="{'fa-long-arrow-alt-down': filters.orderBy.column == 'code' && filters.orderBy.direction == 'asc', 'fa-long-arrow-alt-up': filters.orderBy.column == 'code' && filters.orderBy.direction == 'desc'}"></i>
                        </th>
                        <th class="d-none d-sm-table-cell">
                            <a href="#" class="text-dark" @click.prevent="sort('amount')">Amount</a>
                            <i class="ml-1 fas"
                               :class="{'fa-long-arrow-alt-down': filters.orderBy.column == 'amount' && filters.orderBy.direction == 'asc', 'fa-long-arrow-alt-up': filters.orderBy.column == 'amount' && filters.orderBy.direction == 'desc'}"></i>
                        </th>
                        <th class="d-none d-sm-table-cell"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="sku in skus">
                        <td class="d-none d-sm-table-cell">{{sku.id}}</td>
                        <td>{{sku.name}}</td>
                        <td class="d-none d-sm-table-cell">{{sku.desc}}</td>
                        <td>{{sku.code}}</td>
                        <td class="d-none d-sm-table-cell">{{sku.amount}}</td>
                        <td class="d-none d-sm-table-cell">
                            <a href="#" class="text-muted"><i class="fas fa-pencil-alt"></i></a>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <div class="row" v-if='!loading && filters.pagination.total > 0'>
                    <div class="col pt-2">
                        {{filters.pagination.from}}-{{filters.pagination.to}} of {{filters.pagination.total}}
                    </div>
                    <div class="col" v-if="filters.pagination.last_page>1">
                        <nav aria-label="Page navigation">
                            <ul class="pagination justify-content-end">
                                <li class="page-item" :class="{'disabled': filters.pagination.current_page <= 1}">
                                    <a class="page-link" href="#" @click.prevent="changePage(pagination.current_page -  1)"><i
                                            class="fas fa-angle-left"></i></a>
                                </li>
                                <li class="page-item" v-for="page in filters.pagination.last_page" :class="{'active': filters.pagination.current_page == page}">
                                    <span class="page-link" v-if="filters.pagination.current_page == page">{{page}}</span>
                                    <a class="page-link" href="#" v-else @click.prevent="changePage(page)">{{page}}</a>
                                </li>
                                <li class="page-item" :class="{'disabled': filters.pagination.current_page >= filters.pagination.last_page}">
                                    <a class="page-link" href="#" @click.prevent="changePage(filters.pagination.current_page +  1)"><i
                                            class="fas fa-angle-right"></i></a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <div class="no-items-found text-center mt-5" v-if="!loading && !skus.length > 0">
                    <i class="icon-magnifier fa-3x text-muted"></i>
                    <p class="mb-0 mt-3"><strong>Could not find any items</strong></p>
                    <p class="text-muted">Try changing the filters or add a new one</p>
                </div>
                <content-placeholders v-if="loading">
                    <content-placeholders-text />
                </content-placeholders>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                skus: [],
                filters: {
                    pagination: {
                        from: 0,
                        to: 0,
                        total: 0,
                        per_page: 25,
                        current_page: 1,
                        last_page: 0
                    },
                    orderBy: {
                        column: 'id',
                        direction: 'asc'
                    },
                    search: ''
                },
                loading: true
            }
        },
        mounted() {
            if (localStorage.getItem("filtersTableSkus")) {
                this.filters = JSON.parse(localStorage.getItem("filtersTableSkus"))
            } else {
                localStorage.setItem("filtersTableSkus", this.filters);
            }
            this.getSkus()
        },
        methods: {
            getSkus() {
                this.loading = true
                this.skus    = []

                localStorage.setItem("filtersTableSkus", JSON.stringify(this.filters));

                axios.post(`/api/skus/filter?page=${this.filters.pagination.current_page}`, this.filters)
                    .then(response => {
                        this.skus = response.data.data
                        delete response.data.data
                        this.filters.pagination = response.data
                        this.loading            = false
                    })
            },
            // Filters
            filter() {
                this.filters.pagination.current_page = 1
                this.getSkus()
            },
            changeSize(perPage) {
                this.filters.pagination.current_page = 1
                this.filters.pagination.per_page     = perPage
                this.getSkus()
            },
            sort(column) {
                if (column == this.filters.orderBy.column) {
                    this.filters.orderBy.direction = this.filters.orderBy.direction == 'asc' ? 'desc' : 'asc'
                } else {
                    this.filters.orderBy.column    = column
                    this.filters.orderBy.direction = 'asc'
                }

                this.getSkus()
            },
            changePage(page) {
                this.filters.pagination.current_page = page
                this.getSkus()
            }
        }
    }
</script>
