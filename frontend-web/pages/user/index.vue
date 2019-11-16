<template>
  <v-simple-table>
    <template v-slot:default>
      <thead>
      <tr>
        <th class="text-left">ID</th>
        <th class="text-left">First Name</th>
        <th class="text-left">Last Name</th>
        <th class="text-left">Full Name</th>
        <th class="text-left">Email</th>
      </tr>
      </thead>
      <tbody>
      <tr v-for="user in users" :key="user.id">
        <td>{{ user.id }}</td>
        <td>{{ user.first_name }}</td>
        <td>{{ user.last_name }}</td>
        <td>{{ user.full_name }}</td>
        <td>{{ user.email }}</td>
      </tr>
      </tbody>
    </template>
  </v-simple-table>
</template>

<script>
    export default {
        name: "index",
        components: {},
        data() {
            return {
                users: []
            }
        },
        async created() {
            const config = {
                headers: {
                    Accept: 'application/json'
                }
            };

            const res = await this.$axios.get('/users', config);
            this.users = res.data.data;
        }
    }
</script>

<style scoped>

</style>
