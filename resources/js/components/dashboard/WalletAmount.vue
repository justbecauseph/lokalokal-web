<template>
    <div class="card text-white bg-dark border-0">
        <div class="card-body">
            <div class="h1 text-muted text-right mb-4">
                <i class="icon-wallet"></i>
            </div>
            <div class="text-value"><h2>PHP {{ amount }}</h2></div>
            <h6 class="text-muted text-uppercase font-weight-bold">Wallet amount</h6>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                amount: 0
            }
        },
        mounted() {
            this.getWalletAmount()
        },
        methods: {
            getWalletAmount() {
                axios.get(`/api/users/wallet`)
                    .then(response => {
                        this.amount = response.data.amount
                    })
            },
        }
    }
</script>
