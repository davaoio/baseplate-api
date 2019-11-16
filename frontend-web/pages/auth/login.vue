<template>
  <div>
    <v-content>
      <v-container class="fill-height" fluid>
        <v-row align="center" justify="center">
          <v-col cols="12" sm="8" md="4">
            <v-card class="elevation-12">
              <v-toolbar color="primary" dark flat>
                <v-toolbar-title>Login form</v-toolbar-title>
              </v-toolbar>
              <v-card-text>
                <v-form method="post" @submit.prevent="login">
                  <v-text-field label="Email" name="email" prepend-icon="mdi-email" type="text" v-model="email"/>

                  <v-text-field
                    id="password"
                    label="Password"
                    name="password"
                    prepend-icon="mdi-lock"
                    type="password"
                    v-model="password"
                  />
                </v-form>
              </v-card-text>
              <v-card-actions>
                <v-spacer/>
                <v-btn @click="login" color="primary">Login</v-btn>
              </v-card-actions>
            </v-card>
          </v-col>
        </v-row>
      </v-container>
    </v-content>
  </div>
</template>

<script>
    export default {
        middleware: 'guest',
        head() {
            return {
                title: "Login - Baseplate API"
            }
        },
        data() {
            return {
                email: '',
                password: ''
            }
        },
        methods: {
            async login() {
                try {
                    await this.$auth.loginWith('local', {
                        data: {
                            email: this.email,
                            password: this.password
                        }
                    });

                    this.$router.push('/user/profile');
                } catch (e) {
                    console.log(e);
                }
            }
        },
        props: {
            source: String
        }
    };
</script>

<style scoped>
</style>
