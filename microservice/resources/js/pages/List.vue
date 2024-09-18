<script setup>
import { onMounted, ref } from 'vue'
import { Bootstrap4Pagination } from 'laravel-vue-pagination'

const ads = ref()

let type = 'desc'
let sort = 'created_at'

onMounted(() => getList())

const changePage = (page) => getList(page)
const changeSort = ()  => getList()
const getList = (page = 1)  => {
    axios.post('/api/v1/ads/list', {page: page, type: type, sort: sort})
        .then(res => {
            ads.value = res.data.data
        });
}
</script>
<template>
    <div>
        <div class="panel panel-default col-12">
            <div class="panel-heading">
                <h1>Список объявлений</h1>

                <div>
                    <router-link :to="{name: 'create'}" class="btn btn-success">Создать объявление</router-link>
                </div>
            </div>

            <div class="panel-body" v-if="ads">
                <div v-if="ads.data.length > 0">
                    <div class="panel-navigation">
                        <Bootstrap4Pagination 
                            :data="ads" 
                            @pagination-change-page="changePage"
                        />

                        <div class="panel-sorting">
                            <select v-model="sort" @change="changeSort">
                                <option value="created_at">По дате создания</option>
                                <option value="price">По цене</option>
                            </select>

                            <select v-model="type" @change="changeSort">
                                <option value="desc">По убыванию</option>
                                <option value="asc">По возрастанию</option>
                            </select>
                        </div>
                    </div>

                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Название</th>
                            <th>Цена</th>
                            <th>Фото</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="ad in ads.data" :key="ad.id">
                            <td>
                                <router-link :to="{ name: 'item', params: { id: ad.id } }" v-html="ad.title" />
                            </td>
                            <td>{{ ad.price }}</td>
                            <td><img width="50" :src="ad.photo"></td>
                        </tr>
                        </tbody>
                    </table>

                    <Bootstrap4Pagination 
                        :data="ads" 
                        @pagination-change-page="changePage"
                    />
                </div>

                <div v-else>
                    <p>Объявление не найдены, <router-link :to="{name: 'create'}">создайте первое объявление</router-link>!</p>
                </div>
            </div>

            <div v-else>
                <p>Загружается список объявлений...</p>
            </div>
        </div>
    </div>
</template>
