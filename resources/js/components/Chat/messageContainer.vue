<template>
    <div class="thread__container">
        <div class="thread__container__inner">
            <div v-for="(message, index) in messages" :key="index">
                <message-item :className="message.user_id == userID ? 'sent_message' : 'received_message'" :sentMessage="message.user_id == userID" :message="message" :index="index" />
            </div>
        </div>
    </div>
</template>


<script>
    import messageItem from './messageItem.vue';

    try {
        console.log('user -> ', userID);
    } catch (e) {}

    export default {
        components: { messageItem },
        props: ['userID', 'messages'],
        methods: { 
            created() {
                console.log('id -> ', this.userID);
            }
        }
    };
</script>

<style scoped>
    .thread__container {
        height: 93%;
        display: flex;
        padding: 2em 1em;
    }

    .thread__container__inner {
        height: 100%;
        width: 100%;
        padding: 0 1em;
        overflow-y: scroll;
        margin-top: auto;
        display: flex;
        flex-direction: column-reverse;
        align-content: flex-end;
    }
</style>