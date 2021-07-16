<template>
    <div class="ui__container">

        <chat-room-selection
            v-if="currentRoom.id"
            :rooms="chatRooms"
            :currentRoom="currentRoom"
            v-on:roomChanged="setRoom($event)"
        />

        <div class="chat__container">
            <message-container :userID="userID" :messages="messages" />
            <input-message
                :room="currentRoom"
                v-on:messageSent="getMessages()"
            />
        </div>
    </div>
</template>

<script>
    import MessageContainer from './messageContainer.vue'
    import InputMessage from './inputMessage.vue'
    import ChatRoomSelection from './chatRoomSelection.vue'

    export default {
        components: {
            MessageContainer,
            InputMessage,
            ChatRoomSelection
        },
        data: () => {
            return {
                userID: 0,
                chatRooms: [],
                currentRoom: [],
                messages: [],
            };
        },
        methods: {
            connect() {
                if (this.currentRoom.id) {
                    let vm = this;
                    this.getMessages();

                    window.Echo
                        .private(`private-chat-${this.currentRoom.id}`)
                        .listen('.message.new', (e) => {
                            vm.getMessages();
                        });
                }
            },
            disconnect(room) {
                window.Echo.leave(`private-chat-${room.id}`);
            },
            getRooms() {
                axios.get('/chat/rooms')
                    .then((response) => { 
                        this.chatRooms = response.data;
                        this.setRoom(response.data[0]);
                    })
                    .catch((error) => {
                        console.error(error);
                    });
            },
            setRoom(room) {
                this.currentRoom = room;
            },
            getMessages() {
                axios.get(`/chat/room/${this.currentRoom.id}/messages`)
                    .then((response) => {
                        this.messages = response.data;
                    })
                    .catch((error) => console.error('axios error -> ', error));
            },
        },
        watch: {
            currentRoom(val, oldVal) {
                if (val.id === oldVal.id) {
                    this.disconnect(oldVal);
                }

                this.connect();
            }
        },
        created() {
            const userID = document.querySelector("meta[name='user-id']").getAttribute('content');
            this.userID = userID;
            console.log('userID -> ', userID);
            this.getRooms();
        },
    }
</script>

<style scoped>
    .ui__container {
        display: flex;
        align-items: flex-start;
        height: 100%;
        width: 100%;
        overflow: hidden;
    }

    .chat__container {
        width: 80vw;
        height: 100%;
        border-left: 1px solid #2f3640;
    }
</style>