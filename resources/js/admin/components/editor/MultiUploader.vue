<template>
    <div>
        <div class="row images-list mb-2" v-if="images.length">
            <div class="col-6 col-md-4 col-lg-3" v-for="(image, index) in images" :key="index">
                <div class="image-preview rounded"
                     :style="{backgroundImage: `url(${image.src})`}">
                    <a href="#" class="btn btn-danger btn-round" @click.prevent="remove(index)">
                        <svg>
                            <use xlink:href="#icon--delete"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>

        <label class="position-relative image-uploader d-block rounded bg-light p-4">
            <input type="file"
                   accept="image/*"
                   :name="name.replace('[]','').concat('[]')"
                   multiple
                   @change="handle"
                   ref="input"/>

            <div class="text-center">
                Upload Image
                <div v-if="tooltip">({{ tooltip }})</div>
            </div>
        </label>
    </div>
</template>

<script>
    export default {
        props: {
            items: Array,
            name: {
                type: String,
                default: 'images'
            },
            collection: String,
            tooltip: String,
        },
        data() {
            return {
                images: this.items || [],
                files: []
            }
        },
        methods: {
            async uploadFile(formData) {
                await axios.post('/admin/media/upload', formData)
                    .then(({data}) => {
                        this.images.push(data);
                    });
            },

            handle({target}) {
                const fileList = Array.from(target.files);
                const dt = new DataTransfer();

                if (!fileList.length) return;

                this.files = [...this.files, ...fileList];
                this.files.forEach(file => dt.items.add(file));
                this.$refs.input.files = dt.files;

                fileList.forEach((item, index) => {
                    const reader = new FileReader();
                    reader.onload = ({target}) => {
                        this.images.push({
                            upload: index,
                            src: target.result
                        });
                    };
                    reader.readAsDataURL(item);
                });
            },

            remove(index) {
                const itemToDelete = this.images[index];

                if (!itemToDelete) return;

                if (itemToDelete.hasOwnProperty('upload')) {
                    const dt = new DataTransfer();

                    this.files.splice(itemToDelete.upload, 1);
                    this.files.forEach(file => dt.items.add(file));
                    this.$refs.input.files = dt.files;
                } else {
                    axios.delete(itemToDelete.delete);
                }

                this.images.splice(index, 1);
            }
        }
    }
</script>

<style lang="scss" scoped>
    .previews {
        margin: -0.5rem;
    }

    .images-list {
        margin: -0.5rem;

        [class^="col"] {
            padding: 0.5rem;
        }
    }

    .image-preview {
        position: relative;
        background-size: cover;
        background-position: 50% 50%;
        background-repeat: no-repeat;
        padding-top: 100%;
        overflow: hidden;

        .btn {
            opacity: 0;
            padding: 0;
            position: absolute;
            top: 5px;
            right: 5px;
            width: 24px;
            height: 24px;
            border-radius: 50%;
            transition: 0.35s;
            transform: scale(0);

            svg {
                margin: auto;
                fill: #fff;
                width: 65%;
                height: 65%;
            }
        }

        &:hover {
            .btn {
                opacity: 1;
                visibility: visible;
                transform: scale(1);
            }
        }
    }

    .image-uploader {
        overflow: hidden;

        [type="file"] {
            position: absolute;
            left: -9999px;
        }
    }
</style>
