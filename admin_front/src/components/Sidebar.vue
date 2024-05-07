<template>
    <div class="main-sidebar">
        <aside id="sidebar-wrapper">
            <div class="sidebar-brand">
                <a href="">Admin RiverCrane</a>
            </div>
            <div class="sidebar-brand sidebar-brand-sm">
                <a href=""></a>
            </div>

            <ul class="sidebar-menu">
                <li class="active">
                    <a class="nav-link" href="" data-bs-toggle="tooltip" data-bs-placement="right"
                        title="Quản lý User"><i class="fas fa-hand-point-right"></i>
                        <span>Quản lý User</span>
                    </a>
                </li>
                <li>
                    <a @click.prevent="handleLogout" class="nav-link" href="" data-bs-toggle="tooltip" data-bs-placement="right"
                        title="Đăng xuất"><i class="fas fa-hand-point-right"></i>
                        <span class="text-danger">Đăng xuất</span>
                    </a>
                </li>
            </ul>
        </aside>
    </div>
</template>

<script>
import axios from 'axios';
export default {
    methods: {
    async handleLogout() {
        const token = localStorage.getItem('access_token');

        if (token) {
            try {
                await axios({
                    method: 'post',
                    url: 'http://adminrivercrane.test/api/auth/logout',
                    headers: { Authorization: `Bearer ${token}` },
                });

                // Xóa token khỏi localStorage
                localStorage.removeItem('access_token');
                if (localStorage.getItem('refresh_token') != null) {
                    localStorage.removeItem('refresh_token');
                }
                // Chuyển hướng người dùng về trang đăng nhập
                this.$router.push('/login');
            } catch (error) {
                console.log(error);
            }
        }
    }
}
}
</script>

<style></style>