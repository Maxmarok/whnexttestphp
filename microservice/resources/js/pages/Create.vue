<script setup>
import { ref } from 'vue'
import Back from '../components/Back.vue'
import { useRouter } from 'vue-router'
const router = useRouter()

const ad = ref({
    title: null,
    price: null,
    description: null,
    photos: [],
})

const errors = ref({
    title: null,
    price: null,
    description: null,
    photos: null,
})

const saveForm = () => {
    clearInputs(); // clear empty photos fields
    axios.post('/api/v1/ads/create', ad.value)
        .then(function (res) {
            if(res.status === 200) {
                router.push({name: 'item', params: {id: res.data.data.id}});
            }
        })
        .catch(function (res) {
            if(res.status === 422) errors.value = res.response.data.errors;
        });
}

const changeInput = (input) => errors[input] = null
const clearInputs = () => ad.value.photos = ad.value.photos.filter(x => x !== '' && x !== null )

</script>

<template>
    <div class="d-flex flex-column">
        <div class="form-group col-12 col-lg-6">
            <Back />
        </div>

        <div class="panel panel-default">
            <h1 class="panel-heading col-12 text-center mb-4">Создать объявление</h1>
            
            <div class="panel-body">
                <form @submit.prevent="saveForm">
                    <div class="d-flex flex-lg-row flex-column">
                        <div class="d-flex flex-column col-12 col-lg-6">
                            <div class="col-xs-12 form-group">
                                <label class="control-label">Название</label>
                                <input :class="{'is-invalid': errors.title, 'is-valid': ad.title}" @change="changeInput('title')" type="text" v-model="ad.title" class="form-control">
                                <p class="mb-0 text-danger" v-if="errors.title" v-for="error in errors.title" :key="error" v-html="error" />
                            </div>

                            <div class="col-xs-12 form-group">
                                <label class="control-label">Цена</label>
                                <input :class="{'is-invalid': errors.price, 'is-valid': ad.price}" @change="changeInput('price')" type="text" v-model="ad.price" class="form-control">
                                <p class="mb-0 text-danger" v-if="errors.price" v-for="error in errors.price" :key="error" v-html="error" />
                            </div>

                            <div class="col-xs-12 form-group">
                                <label class="control-label">Описание</label>
                                <textarea :class="{'is-invalid': errors.description, 'is-valid': ad.description}" @change="changeInput('description')" v-model="ad.description" class="form-control" />
                                <p class="mb-0 text-danger" v-if="errors.description" v-for="error in errors.description" :key="error" v-html="error" />
                            </div>
                        </div>
                        <div class="d-flex flex-column col-12 col-lg-6">
                            <div class="col-xs-12 form-group">
                                <label class="control-label">Ссылки на фотографии</label>
                                <input type="text" :class="{'is-invalid': errors.photos || errors['photos.0'], 'is-valid': ad.photos[0]}" @change="changeInput('photos'); changeInput('photos.0')" v-model="ad.photos[0]" class="form-control">
                                <p class="mb-0 text-danger" v-for="error in errors.photos" :key="error" v-html="error" />
                                <p class="mb-0 text-danger" v-for="error in errors['photos.0']" :key="error" v-html="error" />

                                <input type="text" :class="{'is-invalid': errors['photos.1'], 'is-valid': ad.photos[1]}" @change="changeInput('photos.1')" v-model="ad.photos[1]" class="form-control mt-2">
                                <p class="mb-0 text-danger" v-for="error in errors['photos.1']" :key="error" v-html="error" />

                                <input type="text" :class="{'is-invalid': errors['photos.2'], 'is-valid': ad.photos[2]}" @change="changeInput('photos.2')" v-model="ad.photos[2]" class="form-control mt-2">
                                <p class="mb-0 text-danger" v-for="error in errors['photos.2']" :key="error" v-html="error" />
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-lg-6">
                        <div class="col-xs-12 form-group">
                            <button class="btn btn-success">Создать</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
