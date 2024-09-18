<script setup>
import { onMounted, ref } from 'vue'
import Back from '../components/Back.vue'
import { useRoute } from 'vue-router'

const route = useRoute()
const ad = ref()

let id = route.params.id
let fields = false

onMounted(() => getItem())

const getItem = () => {
    axios.post('/api/v1/ads/', {id: id, fields: fields})
        .then(res => {
            ad.value = res.data.data
        });
}

const moreInfo = () => {
    fields = true
    getItem()
}
</script>
<template>
    <div class="d-flex flex-column">
        <div class="form-group mx-auto col-12 col-lg-6">
            <Back />
        </div>

        <div class="panel panel-default col-12 col-lg-6" v-if="ad">
            <h1 class="panel-heading text-center mb-4" v-html="ad.title" />
            <div class="panel-body">
                <div class="d-flex flex-column">
                    <div class="col-xs-12 form-group">
                        <label class="control-label">Цена</label>
                        <input readonly v-model="ad.price" class="form-control" />
                    </div>

                    <div class="col-xs-12 form-group" v-if="ad.description">
                        <label class="control-label">Описание</label>
                        <textarea readonly v-model="ad.description" class="form-control" />
                    </div>

                    <div class="col-xs-12 form-group" v-if="ad.photo">
                        <label class="control-label">Ссылки на фотографии</label>
                        <input readonly :value="ad.photo" class="form-control mb-2" />
                        <input readonly v-if="ad.photos" v-for="photo in ad.photos.split()" :key="ad" :value="photo" class="form-control mb-2" />
                    </div>
                </div>

                <div class="d-flex flex-row justify-content-between">
                    <router-link :to="{name: 'create'}" class="btn btn-success">Создать новое объявление</router-link>
                    <div :onclick="moreInfo" class="btn btn-warning" v-if="!fields">Загрузить больше информации</div>
                </div>
            </div>
        </div>

        <div class="panel panel-default col-12 col-lg-6" v-else>
            <p v-if="error">Объявление не найдено, <router-link :to="{name: 'create'}">создайте новое объявление</router-link></p>
            <p v-else>Загружается объявление #{{id}}...</p>
        </div>
    </div>
</template>