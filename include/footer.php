<link rel="stylesheet" href="css/footer.css">

<footer data-aos="fade-up">
    <div class="footer_left">
        <h2>Mannafest Food Inc.</h2>
        <br>
        <p>One of the leading company that
            <br> provides the best quality of bread in town
        </p>
        <br>
        <br>
        <p id="footer_p_location">Sapphire St.,
            <br> Santiago Rd.,
            <br> Lumbangan, Divisoria
            <br> Zamboanga City, Philippines 7000 Contact Us: 062-926-1993
            <br> Email: mannafest_zam@yahoo.co
        </p>
        <br>
        <br>
        <p>Follow Us</p>
        <img id="fol_us" src="assets/logo/facebook.png" alt="">
        <img id="fol_us" src="assets/logo/instagram.png" alt="">
        <br>
        <br>
        <br>
        <br>
        <p id="copyright">Copyright &copy 2022 Mannafest Food Incorporated, All Rights Reserve</p>
    </div>
    <div class="footer_middle">
        <ul>
            <li><a href="about.php">About Us</a></li>
            <li><a href="">Contact Us</a></li>
            <li><a href="">Return Policy</a></li>

        </ul>
    </div>
    <div class="footer_right">
        <h2>We love to hear from you!</h2>
        <br>

        <form action="function/contact_us.php" method='post'>
            <div class="div_name_email">
                <input type="text" name='name' placeholder="Name">
                <input type="email" name='email' placeholder="Email">
            </div>
            <div class="feedback">
                <textarea name="feedback" id="" cols="30" rows="10" placeholder="Your feedback"></textarea>
            </div>
            <center>
                <button type="submit" name="send" id="feedback_submit">SUBMIT</button>
            </center>
        </form>

    </div>
</footer>


<script src="//cdnjs.cloudflare.com/ajax/libs/validate.js/0.13.1/validate.min.js"></script>
<script>
const constraints = {
    name: {
        presence: {
            allowEmpty: false
        }
    },
    email: {
        presence: {
            allowEmpty: false
        },
        email: true
    },
    message: {
        presence: {
            allowEmpty: false
        }
    }
};

const form = document.getElementById('contact-form');
form.addEventListener('submit', function(event) {

    const formValues = {
        name: form.elements.name.value,
        email: form.elements.email.value,
        message: form.elements.message.value
    };


    const errors = validate(formValues, constraints);
    if (errors) {
        event.preventDefault();
        const errorMessage = Object
            .values(errors)
            .map(function(fieldValues) {
                return fieldValues.join(', ')
            })
            .join("\n");

        alert(errorMessage);
    }
}, false);
</script>



<script>
// Variables we will use in our app
let currentChatTab = 1;
let conversationId = null;
let status = 'Idle';

// OnClick event handler for our open chat button
document.querySelector('.open-chat-widget').onclick = event => {
    event.preventDefault();
    // Execute the initialize chat function
    initChat();
};
// Intialize chat function - handle all aspects of the chat widget
const initChat = () => {
    // Show the chat widget
    document.querySelector('.chat-widget').style.display = 'flex';
    // Animate the chat widget
    document.querySelector('.chat-widget').getBoundingClientRect();
    document.querySelector('.chat-widget').classList.add('open');
    // Close button OnClick event handler
    document.querySelector('.close-chat-widget-btn').onclick = event => {
        event.preventDefault();
        // Close the chat
        document.querySelector('.chat-widget').classList.remove('open');
    };
    // Login form submit event handler
    document.querySelector('.chat-widget-login-tab form').onsubmit = event => {
        event.preventDefault();
        // Declare form related variables
        let formEle = document.querySelector('.chat-widget-login-tab form');
        let formData = new FormData(formEle);
        // Execute POST AJAX request and attempt to authenticate the user
        fetch(formEle.action, {
            cache: 'no-store',
            method: 'POST',
            body: formData
        }).then(response => response.text()).then(data => {
            // If the response includes the "operator" string
            if (data.includes('operator')) {
                // Show the password field
                document.querySelector('.chat-widget-login-tab .msg').insertAdjacentHTML(
                    'beforebegin',
                    '<input type="password" name="password" placeholder="Your Password" required>'
                );
            } else if (data.includes('success')) {
                // Authentication success! Execute AJAX request to retrieve the user's conversations

                fetch('chat_system/conversations.php', {
                    cache: 'no-store'
                }).then(response => response.text()).then(data => {
                    // Update the status
                    status = 'Idle';
                    // Update the conversations tab content
                    document.querySelector('.chat-widget-conversations-tab').innerHTML =
                        data;
                    // Execute the conversation handler function
                    conversationHandler();
                    // Transition to the conversations tab
                    selectChatTab(2);
                });

            } else {
                // Authentication failed! Show the error message on the form
                document.querySelector('.chat-widget-login-tab .msg').innerHTML = data;
            }
        });
    };
    // If the secret code cookie exists, attempt to automatically authenticate the user
    if (document.cookie.match(/^(.*;)?\s*chat_secret\s*=\s*[^;]+(.*)?$/)) {
        // Execute GET AJAX request to retireve the conversations
        fetch('chat_system/conversations.php', {
            cache: 'no-store'
        }).then(response => response.text()).then(data => {
            // If respone not equals error
            if (data != 'error') {
                // User is authenticated! Update the status and conversations tab content
                status = 'Idle';
                document.querySelector('.chat-widget-conversations-tab').innerHTML = data;
                // Execute the conversation handler function
                conversationHandler();
                // Transition to the conversations tab
                selectChatTab(2);
            }
        });
    }
    // Previous tab button OnClick event handler
    document.querySelector('.previous-chat-tab-btn').onclick = event => {
        event.preventDefault();
        // Transition to the respective page
        selectChatTab(currentChatTab - 1);
    };
};

// Select chat tab - it will be used to smoothly transition between tabs
const selectChatTab = value => {
    // Update the current tab variable
    currentChatTab = value;
    // Select all tab elements and add the CSS3 property transform
    document.querySelectorAll('.chat-widget-tab').forEach(element => element.style.transform =
        `translateX(-${(value-1)*100}%)`);
    // If the user is on the first tab, hide the prev tab button element
    document.querySelector('.previous-chat-tab-btn').style.display = value > 1 ? 'block' : 'none';
    // Update the conversation ID variable if the user is on the first or second tab
    if (value == 1 || value == 2) {
        conversationId = null;
    }
    // If the user is on the login form tab (tab 1), remove the secret code cookie (logout)
    if (value == 1) {
        document.cookie = 'chat_secret=;expires=Thu, 01 Jan 1970 00:00:01 GMT;';
    }
};


// Conversation handler function - will add the event handlers to the conversations list and new chat button
const conversationHandler = () => {
    // New chat button OnClick event handler
    document.querySelector('.chat-widget-new-conversation').onclick = event => {
        event.preventDefault();
        // Update the status
        status = 'Waiting';
        // Notify the user
        document.querySelector('.chat-widget-conversation-tab').innerHTML =
            '<div class="chat-widget-messages">' +
            '<div class="chat-widget-message">Please wait...</div>' +
            '</div>';
        // Transition to the conversation tab (tab 3)
        selectChatTab(3);
    };
    // Iterate the conversations and add the OnClick event handler to each element
    document.querySelectorAll('.chat-widget-conversation').forEach(element => {
        element.onclick = event => {
            event.preventDefault();
            // Get the conversation
            // Execute the getConversation function here
            getConversation(element.dataset.id);
        };
    });
};

// Get conversation function - execute an AJAX request that will retrieve the conversation based on the conversation ID column
const getConversation = id => {
    // Execute GET AJAX request
    fetch(`chat_system/conversation.php?id=${id}`, {
        cache: 'no-store'
    }).then(response => response.text()).then(data => {
        // Update conversation ID variable
        conversationId = id;
        // Update the status
        status = 'Occupied';
        // Update the converstaion tab content
        document.querySelector('.chat-widget-conversation-tab').innerHTML = data;
        // Transition to the conversation tab (tab 3)
        selectChatTab(3);
        // Retrieve the input message form element 
        let chatWidgetInputMsg = document.querySelector('.chat-widget-input-message');
        // If the element exists
        if (chatWidgetInputMsg) {
            // Scroll to the bottom of the messages container
            if (document.querySelector('.chat-widget-messages').lastElementChild) {
                document.querySelector('.chat-widget-messages').scrollTop = document.querySelector(
                    '.chat-widget-messages').lastElementChild.offsetTop;
            }
            // Message submit event handler
            chatWidgetInputMsg.onsubmit = event => {
                event.preventDefault();
                // Execute POST AJAX request that will send the captured message to the server and insert it into the database
                fetch(chatWidgetInputMsg.action, {
                    cache: 'no-store',
                    method: 'POST',
                    body: new FormData(chatWidgetInputMsg)
                });
                // Create the new message element
                let chatWidgetMsg = document.createElement('div');
                chatWidgetMsg.classList.add('chat-widget-message');
                chatWidgetMsg.textContent = chatWidgetInputMsg.querySelector('input').value;
                // Add it to the messages container, right at the bottom
                document.querySelector('.chat-widget-messages').insertAdjacentElement(
                    'beforeend',
                    chatWidgetMsg);
                // Reset the message element
                chatWidgetInputMsg.querySelector('input').value = '';
                // Scroll to the bottom of the messages container
                document.querySelector('.chat-widget-messages').scrollTop = chatWidgetMsg
                    .offsetTop;
            };
        }
    });
};

// Update the conversations and messages in real-time
setInterval(() => {
    // If the current tab is 2
    if (currentChatTab == 2) {
        // Use AJAX to update the conversations list
        fetch('chat_system/conversations.php', {
            cache: 'no-store'
        }).then(response => response.text()).then(html => {
            let doc = (new DOMParser()).parseFromString(html, 'text/html');
            document.querySelector('.chat-widget-conversations').innerHTML = doc.querySelector(
                '.chat-widget-conversations').innerHTML;
            conversationHandler();
        });
        // If the current tab is 3 and the conversation ID variable is not NUll               
    } else if (currentChatTab == 3 && conversationId != null) {
        // Use AJAX to update the conversation
        fetch('chat_system/conversation.php?id=' + conversationId, {
            cache: 'no-store'
        }).then(response => response.text()).then(html => {
            // The following variable will prevent the messages container from automatically scrolling to the bottom if the user previously scrolled up in the chat list
            let canScroll = true;
            if (document.querySelector('.chat-widget-messages').lastElementChild && document
                .querySelector('.chat-widget-messages').scrollHeight - document.querySelector(
                    '.chat-widget-messages').scrollTop != document.querySelector(
                    '.chat-widget-messages').clientHeight) {
                canScroll = false;
            }
            let doc = (new DOMParser()).parseFromString(html, 'text/html');
            // Update content
            document.querySelector('.chat-widget-messages').innerHTML = doc.querySelector(
                '.chat-widget-messages').innerHTML;
            if (canScroll && document.querySelector('.chat-widget-messages').lastElementChild) {
                // Scroll to the bottom of the container
                document.querySelector('.chat-widget-messages').scrollTop = document
                    .querySelector(
                        '.chat-widget-messages').lastElementChild.offsetTop;
            }
        });
        // If the current tab is 3 and the status is Waiting           
    } else if (currentChatTab == 3 && status == 'Waiting') {
        // Attempt to find a new conversation between the user and operator (or vice-versa)
        fetch('chat_system/find_conversation.php', {
            cache: 'no-store'
        }).then(response => response.text()).then(data => {
            if (data != 'error') {
                // Success! Two users are now connected! Retrieve the new conversation
                getConversation(data);
            }
        });
    }
}, 5000); // 5 seconds (5000ms) - the lower the number, the more demanding it is on your server.
</script>