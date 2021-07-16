<template>
    <div class="relative ht-10 m-1">
        <div class="form-wrapper">
            <input
                type="text"
                v-model="message"
                @keyup.enter="sendMessage()"
                placeholder="Say something intelligent"
                class="form-control pt-1"
            />

            <button
                @click="sendMessage()"
                class="button"
            >
                Send
            </button>
        </div>
    </div>
</template>


<script>
    export default {
        props: ['room'],
        data: () => {
            return {
                message: '',
     
            }
        },
        methods: {
            sendMessage() {
                if (this.message === '') {
                    return;
                }

                axios.post(
                    `/chat/room/${this.room.id}/message`, {
                        message: this.message
                    }
                ).then((response) => {
                    if (response.status === 201) {
                        this.message = '';
                        this.$emit('messageSent');
                    }
                }).catch((error) => {console.error(error);})
            }
        },
    };
</script>

<style scoped>
    .form-wrapper {
        display: flex;
        align-items: center;
        justify-content: flex-start;
        padding: 0 2em;
    }

    .form-control {
        background: #2d2d2d;
        color: #fefefe;
        border: 0;
        border-radius: 0;
        margin-right: 1em;
        
        border-bottom: 1px solid #2f3640;
        transition: border 200ms linear;
    }

    .form-control:focus {
        border-bottom-color: coral;
        transition: border 200ms linear;
        outline: 0;
        outline-offset: 0;
        box-shadow: none;
    }

    .button {
        background: coral;
        border-radius: 25px;
        color: #fefefe;
        padding: 5px 15px;
    }


</style>