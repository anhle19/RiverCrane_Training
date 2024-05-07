<template>
    <div class="login">
        <div class="main-wrapper">
            <section class="section">
                <div class="container container-login">
                    <div class="row">
                        <div
                            class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                            <div class="card card-primary border-box">
                                <div class="card-header card-header-auth">
                                    <h4 class="text-center">User Login</h4>
                                </div>
                                <div class="card-body card-body-auth">
                                    <form method="POST" @submit.prevent="submit">
                                        <div class="form-group">
                                            <input v-model="email" type="email" class="form-control" name="email"
                                                placeholder="Email" value="" autofocus>
                                        </div>
                                        <div class="form-group">
                                            <input v-model="password" type="password" class="form-control"
                                                name="password" placeholder="Password">
                                        </div>
                                        <div class="form-group">
                                            <button @click="handleLogin" type="submit"
                                                class="btn btn-primary btn-lg btn-block">
                                                Đăng nhập
                                            </button>
                                        </div>
                                        <div class="form-group">
                                            <div>
                                                <input v-model="remember" type="checkbox" name="remember" value="1">
                                                <label for="remember"> Remember?</label>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import iziToast from 'izitoast'

export default {
    data() {
        return {
            email: '',
            password: '',
            remember: false
        };
    },
    methods: {
        async handleLogin() {
            let credentials = {
                email: this.email,
                password: this.password
            }

            if (credentials.email != '' && credentials.password != '') {
                try {
                    const response = await axios({
                        method: 'post',
                        url: 'http://adminrivercrane.test/api/auth/login',
                        data: credentials,
                    });

                    localStorage.setItem('access_token', response.data.access_token);
                    if (this.remember) {
                        localStorage.setItem('refresh_token', response.data.refresh_token);
                    }
                    this.$router.push('/');
                } catch (error) {
                    iziToast.error({
                        title: '',
                        position: 'topRight',
                        message: error.response.data.error
                    });
                    // In ra từng lỗi validation
                    for (const field in error.response.data.errors) {
                        error.response.data.errors[field].forEach(error => {
                            iziToast.error({
                                title: '',
                                position: 'topRight',
                                message: error
                            });
                        });
                    }
                }
            } else {
                iziToast.error({
                    title: '',
                    position: 'topRight',
                    message: 'Thiếu thông tin đăng nhập'
                });
            }
        }
    }
};
</script>

<style scoped>
/* Styles for the login page go here */
</style>