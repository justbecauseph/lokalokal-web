<template>
  <div class="card bg-light border-0">
    <div class="card-body">
      <div class="h1 text-muted text-right mb-4">
        <i class="icon-key"></i>
      </div>
      <div class="text-value"><h2>{{roles}}</h2></div>
      <h6 class="text-muted text-uppercase font-weight-bold">Roles created</h6>
    </div>
  </div>
</template>

<script>
export default {
  data () {
    return {
      roles: 0
    }
  },
  mounted () {
    this.getRolesCount()
  },
  methods: {
    getRolesCount () {
      axios.get(`/api/roles/count`)
      .then(response => {
        this.roles = response.data
      })
    },
  }
}
</script>
