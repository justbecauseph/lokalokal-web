<template>
    <div>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="/skus">
                    <i class="fa fa-chevron-left mr-1"></i>
                    SKU
                </a>
            </li>
            <li class="breadcrumb-item active">Edit</li>
            <li class="breadcrumb-menu">
                <a class="btn btn-primary" href="#" :disabled="submiting" @click.prevent="update">
                    <i class="fas fa-spinner fa-spin" v-if="submiting"></i>
                    <i class="far fa-save" v-else></i>
                    <span class="d-md-down-none ml-1">Save changes</span>
                </a>
                <a class="btn btn-link" href="#" :disabled="submitingDestroy" @click.prevent="destroy">
                    <i class="fas fa-spinner fa-spin" v-if="submitingDestroy"></i>
                    <i class="far fa-trash-alt" v-else></i>
                    <span class="d-md-down-none ml-1"> Delete</span>
                </a>
            </li>
        </ol>
        <div class="container">
            <div class="card-body px-0">
                <div class="row justify-content-md-center" v-if="!loading">
                    <div class="form-group col-md-12">
                        <img v-bind:src="'data:image/svg+xml;base64,'+ sku.qr_code" class="mx-auto d-block" height="200" width="200"/>
                    </div>
                </div>
                <div class="row justify-content-md-center" v-if="!loading">
                    <div class="form-group col-md-9 col-xl-5">
                        <label>Name</label>
                        <input type="text" class="form-control" :class="{'is-invalid': errors.name}" v-model="sku.name" placeholder="John Doe">
                        <div class="invalid-feedback" v-if="errors.name">{{errors.name[0]}}</div>
                    </div>
                    <div class="form-group col-md-3 col-xl-2">
                        <label>ID</label>
                        <input class="form-control" type="text" v-model="sku.id" readonly>
                    </div>
                    <div class="col-md-12 col-xl-7">
                        <div class="form-group">
                            <label>Description</label>
                            <textarea class="form-control" :class="{'is-invalid': errors.desc}" v-model="sku.desc" placeholder="Description"></textarea>
                            <div class="invalid-feedback" v-if="errors.desc">{{errors.desc[0]}}</div>
                        </div>
                        <div class="form-group">
                            <label>Code</label>
                            <input type="text" class="form-control" :class="{'is-invalid': errors.code}" v-model="sku.code">
                            <div class="invalid-feedback" v-if="errors.code">{{errors.code[0]}}</div>
                        </div>
                        <div class="form-group">
                            <label>Amount</label>
                            <input type="number" class="form-control" :class="{'is-invalid': errors.amount}" v-model="sku.amount">
                            <div class="invalid-feedback" v-if="errors.amount">{{errors.amount[0]}}</div>
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        <label>Image</label>
                        <img v-bind:src="'/'+sku.avatar" class="mx-auto d-block img-fluid">
                    </div>
                </div>
                <div class="row justify-content-md-center" v-else>
                    <div class="col-md-12 col-xl-7">
                        <content-placeholders>
                            <content-placeholders-text />
                        </content-placeholders>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                sku: {},
                errors: {},
                loading: true,
                submiting: false,
                submitingDestroy: false
            }
        },
        mounted() {
            this.getSku()
        },
        methods: {
            getSku() {
                this.loading = true
                let str      = window.location.pathname
                let res      = str.split("/")
                axios.get(`/api/skus/${res[2]}/show`)
                    .then(response => {
                        this.sku = response.data
                    })
                    .catch(error => {
                        this.$toasted.global.error('SKU does not exist!')
                        location.href = '/skus'
                    })
                    .then(() => {
                        this.loading = false
                    })
            },
            update() {
                if (!this.submiting) {
                    this.submiting = true
                    axios.put(`/api/skus/update/${this.sku.id}`, this.sku)
                        .then(response => {
                            this.$toasted.global.error('Updated sku!')
                            location.href = '/skus'
                        })
                        .catch(error => {
                            this.errors    = error.response.data.errors
                            this.submiting = false
                        })
                }
            }
        }
    }
</script>
