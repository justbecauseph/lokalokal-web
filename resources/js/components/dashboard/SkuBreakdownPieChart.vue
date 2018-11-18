<template>
    <div class="small">
        <pie-chart :chart-data="datacollection"></pie-chart>
    </div>
</template>

<script>
    import PieChart from './SkuBreakdownPieChart.js'

    export default {
        components: {
            PieChart
        },
        data () {
            return {
                datacollection: null
            }
        },
        mounted () {
            this.fillData()
        },
        methods: {
            fillData () {
                this.datacollection = {
                    labels: ['Credit', 'Debit'],
                    datasets: [
                        {
                            backgroundColor: ['#353a40', '#000000'],
                            data: [this.getRandomInt(), this.getRandomInt()]
                        }
                    ]
                }
            },
            getRandomInt () {
                return Math.floor(Math.random() * (50 - 5 + 1)) + 5
            }
        }
    }
</script>

<style>
    .small {
        max-width: 600px;
        margin:  150px auto;
    }
</style>
