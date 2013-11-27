# Supported Commands

The commands are designed to be obvious and easily readable.

 * `AUTH COOKIE` - Authenticate the sender with a cookie
 * `AUTH SECRET` - Authenticate a user with a shared secret
 * `DATA` - Begins a data block transfer, for what is comparable to a MIME part of a multipart message.
 * `DELIVER` - Deliver a message to a IMID
 * `DONE` - Sends the message initiated with `DELIVER TO` and composed with `DATA`.
 * `MBOX CHECK` - Check the status of a mailbox
 * `MBOX FETCH` - Retrieve the contents of a mailbox, or a single message
 * `MBOX INDEX` - Retrieve the index of a mailbox
 * `PUSH` - Deliver a push-notification to an IMID
 * `PUBLISH` - Publish to a node or create a new published node
 * `SUBSCRIBE` - Subscribe to a published node or list the current subscriptions
 * `SET` - Set a configuration value for the session
 * `SET GLOBAL` - Set a configuration value for the account
 * `UNSUBSCRIBE` - Unsubscribe to a published node


## AUTH command

~~~~
    AUTH COOKIE <cookie> <issuer>
    AUTH SECRET <account> [<devicename>]
~~~~

Cookie authentication allows for the mailer daemon to authenticate the remote host. This authentication method is only available for domains. Users have to use Shared Secret authentication.

The purpose of Cookie authentication is not to authenticate the sender per se, but rather to authenticate the sending domain in order to be sure that the sending domain is who it says it is.

### AUTH COOKIE command

1. `alice@a.com` sends a message to `bob@b.com`.
2. `a.com` connects to `b.com` and generates a cookie which it sends over with the domain name.
3. `b.com` connects back to `a.com' and verifies the cookie.
4. `a.com` authenticates the sending agent (note: not necessarily the sending user)

### AUTH SECRET command

## DATA command

Transfers a data block from the client to the server.

**Syntax:**

~~~~
    DATA [NAME name] [TYPE mime-type] [LENGTH size] [+BASE64] [+CONTENT]
~~~~

**Parameters:**

 * *name* - The name of the data block, f.ex. "image.jpg".
 * *mime-type* - The mime-type of the data block, f.ex. "image/jpeg".
 * `LENGTH` defines the length of the content if present.
 * `+BASE64` indicates that the data is base64-encoded.
 * `+CONTENT` indicates that this is the content data block of the message.


## DELIVER command

Deliver a message to a mailbox.

**Syntax:**

~~~~
    DELIVER TO target-host [+/-IMPORTANT] [+MULTIPART]
~~~~

**Parameters:**

 * *target-host* - The final recipient host that has the ability to decrypt the envelope to find the recipient for final delivery to the mailbox.
 * `+IMPORTANT` indicates high priority, `-IMPORTANT` indicates low priority. Not specifying either indicates normal priority
 * `+MULTIPART` indicates a multipart message.

**Notes:**

Upon receiving this command the server will announce it being ready to receive the message, or indicate an error if the message can not be delivered. The client should then go on and send the message as a data block:

~~~~
    C:  DELIVER TO noccy+analytics@noccylabs.info +IMPORTANT +MULTIPART
    S:  270 Ok, ready to deliver. Give me your DATA.
    C:  DATA logo.jpg TYPE image/jpg +BASE64
    S:  271 logo.jpg Saving part
         ::
        Client sends base64-encoded data, ends it with two blank lines.
         ::
    S:  272 logo.jpg Part saved
    C:  DATA index.html TYPE text/html LENGTH 1742 +CONTENT
    S:  271 index.html Saving content part
         ::
    S:  272 index.html Part saved
    C:  DONE
    S:  
~~~~

## DONE command

Indicates that the client is done sending data for the delivery


## MBOX command

### MBOX CHECK command

### MBOX FETCH command

### MBOX INDEX command


## PUSH command

## PUBLISH command

## SUBSCRIBE command

Subscribe to a publisher, allowing the publisher to `PUSH` notifications.
To unsubscribe use the `UNSUBSCRIBE` command. 

**Syntax:**

~~~~
    SUBSCRIBE TO feed@domain
    SUBSCRIBE LIST
~~~~

**Example:**

~~~~
    C:  SUBSCRIBE TO noccylabs/immp-spec@github.com
    S:  380 Subscribing to publisher
    S:  280 Subscribed to: Notifications for noccylabs/immp-spec
    C:  SUBSCRIBE LIST
    S:  281 33af50bc-4841-4426-b27f-793186b52171 noccylabs/immp-spec
    S:  282 1 subscriptions.
~~~~

## SET command

### SET GLOBAL command

## UNSUBSCRIBE command

Removes a subscription
