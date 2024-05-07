<template>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form @submit.prevent="searchUser" action="" method="get">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="searchNameInput" class="form-label">Tên</label>
                                    <input v-model="searchForm.name" id="searchNameInput" name="name" type="text"
                                        class="form-control mb-3" placeholder="Nhập họ tên" value="">
                                </div>
                                <div class="mb-3">
                                    <label for="searchEmailInput" class="form-label">Email</label>
                                    <input v-model="searchForm.email" id="searchEmailInput" name="email" type="text"
                                        class="form-control mb-3" placeholder="Nhập email" value="">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="searchGropuRoleSelect" class="form-label">Nhóm</label>
                                    <select v-model="searchForm.group_role" name="group_role" id="searchGropuRoleSelect"
                                        class="form-control mb-3">
                                        <option value="">--- Nhóm ---</option>
                                        <option value="Admin">Admin
                                        </option>
                                        <option value="Editor">Editor
                                        </option>
                                        <option value="Reviewer">Reviewer
                                        </option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="searchIsActiveSelect" class="form-label">Trạng thái</label>
                                    <select v-model="searchForm.is_active" name="is_active" id="searchIsActiveSelect"
                                        class="form-control mb-3">
                                        <option value="">--- Trạng thái ---</option>
                                        <option value="1">Đang hoạt động
                                        </option>
                                        <option value="0">Tạm khóa
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col text-end">
                                <button id="searchBtn" type="submit" class="btn btn-primary"><i
                                        class="fa-solid fa-magnifying-glass"></i>
                                    Tìm kiếm</button>

                                <button @click="clearSearchUser" id="clearSearchButton" type="button"
                                    class="btn btn-primary"><i class="fa-solid fa-eraser"></i> Xóa tìm kiếm</button>
                            </div>
                        </div>
                    </form>
                    <div class="row mt-3">
                        <div class="col">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                data-bs-target="#addUserModal">
                                <i class="fa-solid fa-plus"></i> Thêm mới</button>
                            <!-- Modal Add User -->
                            <AddUser></AddUser>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div id="tableCard" class="card-body">
                    <span v-if="users.total == 0" class="text-danger">Không có kết quả</span>
                    <div v-else class="table-responsive">
                        <table id="usersTable" class="table caption-top table-striped">
                            <caption id="captionTable">Hiển thị từ {{ users.from }} ~ {{ users.to }}
                                trong tổng số
                                {{ users.total }}</caption>
                            <thead>
                                <tr>
                                    <th scope="col">STT</th>
                                    <th scope="col"><a @click.prevent="sortUsers('name')" href="">Tên</a></th>
                                    <th scope="col"><a @click.prevent="sortUsers('email')" href="">Email</a></th>
                                    <th scope="col"><a @click.prevent="sortUsers('group_role')" href="">Nhóm</a></th>
                                    <th scope="col"><a @click.prevent="sortUsers('is_active')" href="">Trạng thái</a>
                                    </th>
                                    <th scope="col">Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(user, index) in users.data" :key="user.id">
                                    <th>{{ index + 1 }}</th>
                                    <td>{{ user.name }}</td>
                                    <td>{{ user.email }}</td>
                                    <td>{{ user.group_role }}</td>
                                    <td>
                                        <span v-if="user.is_active == 1" class="text-success">Đang hoạt động</span>
                                        <span v-else class="text-danger">Tạm khóa</span>
                                    </td>
                                    <td>
                                        <div class="btn-group btn-group-sm" role="group"
                                            aria-label="Basic mixed styles example">
                                            <button id="editUserButton" type="button" class="btn btn-primary"
                                                data-bs-toggle="modal" :data-bs-target="'#editUserModal_' + user.id"><i
                                                    class="fa-regular fa-pen-to-square"></i></button>
                                            <a id="deleteUserButton" href="#" type="button" class="btn btn-danger"
                                                @click.prevent="confirmDelete(user, index)"><i
                                                    class="fa-solid fa-trash"></i></a>
                                            <a v-if="user.is_active == 1" id="lockUserButton" href="#" type="button"
                                                class="btn btn-warning" @click.prevent="confirmLock(user)">
                                                <i class="fa-solid fa-lock"></i></a>
                                            <a v-else id="unlockUserButton" href="#" type="button"
                                                class="btn btn-success" @click.prevent="confirmLock(user)">
                                                <i class="fa-solid fa-unlock"></i></a>
                                        </div>
                                        <!-- Modal Edit User -->
                                        <EditUser :user="user"></EditUser>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div>
                            <nav v-if="pagination && pagination.links && (pagination.total / pagination.per_page) > 1">
                                <ul class="pagination">
                                    <li class="page-item" v-if="pagination.prev_page_url">
                                        <a class="page-link"
                                            @click.prevent="goToPage(pagination.prev_page_url)">Previous</a>
                                    </li>
                                    <li class="page-item" v-for="link in pagination.links.slice(1, -1)"
                                        :key="link.label" :class="{ active: link.active }">
                                        <a class="page-link" @click.prevent="goToPage(link.url)">{{ link.label
                                            }}</a>
                                    </li>
                                    <li class="page-item" v-if="pagination.next_page_url">
                                        <a class="page-link"
                                            @click.prevent="goToPage(pagination.next_page_url)">Next</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { ref, onMounted } from 'vue';
import axios from 'axios';
import AddUser from './AddUser.vue';
import EditUser from './EditUser.vue';
import iziToast from 'izitoast'

export default {
    components: {
        AddUser,
        EditUser
    },
    setup() {
        const users = ref([])
        const pagination = ref([])
        const token = localStorage.getItem('access_token')
        const searchForm = ref({
            name: '',
            email: '',
            group_role: '',
            is_active: ''
        })
        let currentSort = 'id'
        let currentSortDir = 'asc'
        let isSearching = false

        // Làm mới token khi hết hạn
        const refreshToken = async () => {
            const refresh_token = localStorage.getItem('refresh_token');
            if (refresh_token) {
                try {
                    const response = await axios({
                        method: 'POST',
                        url: `http://adminrivercrane.test/api/auth/refresh`,
                        headers: { Authorization: `Bearer ${token}` },
                        data: { refresh_token: refresh_token }
                    });
                    localStorage.setItem('access_token', response.data.access_token);
                    localStorage.setItem('refresh_token', response.data.refresh_token);
                } catch (error) {
                    console.error('Error refreshing token', error);
                }
            } else {
                console.error('No refresh token found');
                localStorage.removeItem('access_token');
                this.$router.push('/login');
            }
        }

        // Thiết lập hàm refreshToken để chạy sau mỗi 60 phút
        setInterval(refreshToken, 50 * 60 * 1000);

        // Lấy danh sách user khi khởi tạo trang
        const getUsers = async () => {
            if (token) {
                isSearching = false
                try {
                    const response = await axios({
                        method: 'GET',
                        url: `http://adminrivercrane.test/api/crud/user?currentSort=${currentSort}&currentSortDir=${currentSortDir}`,
                        headers: { Authorization: `Bearer ${token}` },
                    });
                    users.value = response.data.users
                    pagination.value = response.data.users
                } catch (error) {
                    console.log(error);
                }
            }
        }

        //Tìm kiếm user
        const searchUser = async () => {
            if (token) {
                isSearching = true
                try {
                    const response = await axios({
                        method: 'GET',
                        url: `http://adminrivercrane.test/api/crud/user/search?name=${searchForm.value.name}&email=${searchForm.value.email}&group_role=${searchForm.value.group_role}&is_active=${searchForm.value.is_active}&currentSort=${currentSort}&currentSortDir=${currentSortDir}`,
                        headers: { Authorization: `Bearer ${token}` },
                    });
                    users.value = response.data.users
                    pagination.value = response.data.users
                } catch (error) {
                    console.log(error);
                }
            }
        }

        //Xoá tìm kiếm và lấy lại danh sách user ban đầu
        const clearSearchUser = async () => {
            isSearching = false
            searchForm.value = {
                name: '',
                email: '',
                group_role: '',
                is_active: ''
            };
            getUsers()
        }

        // Xử lý khi phân trang
        const goToPage = async (url) => {
            if (token) {
                try {
                    const response = await axios({
                        method: 'get',
                        url: url,
                        headers: { Authorization: `Bearer ${token}` },
                    });
                    users.value = response.data.users
                    pagination.value = response.data.users
                } catch (error) {
                    console.log(error);
                }
            }
        }

        // Xử lý khoá/mở khoá tài khoản
        const confirmLock = async (user) => {
            if (confirm(`Bạn có chắc muốn khoá/mở khoá thành viên ${user.name} không ?`)) {
                if (token) {
                    try {
                        const response = await axios({
                            method: 'PUT',
                            url: `http://adminrivercrane.test/api/crud/user/lock/${user.id}`,
                            headers: { Authorization: `Bearer ${token}` }
                        })
                        if (response.data.success) {
                            user.is_active = response.data.status
                            iziToast.success({
                                title: '',
                                position: 'topRight',
                                message: response.data.message
                            })
                            if (response.data.isLogin) {
                                localStorage.removeItem('access_token');
                                if (localStorage.getItem('refresh_token') != null) {
                                    localStorage.removeItem('refresh_token');
                                }
                            }
                        }
                    } catch (error) {
                        console.log(error)
                        iziToast.error({
                            title: '',
                            position: 'topRight',
                            message: 'Đã có lỗi xảy ra'
                        });
                    }
                }
            }
        }

        //Xử lý xoá tài khoản
        const confirmDelete = async (user, index) => {
            if (confirm(`Bạn có chắc muốn xóa thành viên ${user.name} không ?`)) {
                if (token) {
                    try {
                        const response = await axios({
                            method: 'DELETE',
                            url: `http://adminrivercrane.test/api/crud/user/delete/${user.id}`,
                            headers: { Authorization: `Bearer ${token}` }
                        })
                        if (response.data.success) {
                            users.value.data.splice(index, 1)
                            iziToast.success({
                                title: '',
                                position: 'topRight',
                                message: response.data.message
                            })
                            if (response.data.isLogin) {
                                localStorage.removeItem('access_token');
                                if (localStorage.getItem('refresh_token') != null) {
                                    localStorage.removeItem('refresh_token');
                                }
                            }
                        }
                    } catch (error) {
                        console.log(error)
                        iziToast.error({
                            title: '',
                            position: 'topRight',
                            message: 'Đã có lỗi xảy ra'
                        });
                    }
                }
            }
        }

        // Xử lý sắp xếp user
        // Thay đổi thứ tự sắp xếp
        // Lấy trường để sắp xếp và phân biệt giữa lấy danh sách user và search kèm trường sắp xếp
        const sortUsers = async (sort) => {
            currentSort = sort //Lấy thông tin trường để sort
            currentSortDir = (currentSortDir == 'asc') ? 'desc' : 'asc'
            if (token) {
                try {
                    if (isSearching) {
                        searchUser()
                    } else {
                        getUsers()
                    }
                } catch (error) {
                    console.log(error);
                }
            }
        }

        // Gọi phương thức lấy danh sách user khi mounted trang
        onMounted(getUsers)

        // Khai báo để phần template có thể lấy ra sử dụng
        return {
            users,
            pagination,
            searchForm,
            goToPage,
            confirmLock,
            confirmDelete,
            searchUser,
            clearSearchUser,
            refreshToken,
            sortUsers
        }
    }
}
</script>

<style></style>