<template>
  <div class="card text-white bg-dark border-0">
    <div class="card-body">
      <div class="h1 text-muted text-right mb-4">
        <i class="icon-people"></i>
      </div>
      <div class="text-value"><h2>{{users}}</h2></div>
      <h6 class="text-muted text-uppercase font-weight-bold">Users registered</h6>
    </div>
  </div>
</template>

<script>
export default {
  data () {
    return {
      users: 0
    }
  },
  mounted () {
    this.getUsersCount()
  },
  methods: {
    getUsersCount () {
      axios.get(`/api/users/count`)
      .then(response => {
        this.users = response.data
      })
    },
  }
}
</script>
