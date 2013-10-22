\newpage

# Features

## IMIDs instead of E-Mail Addresses

IMIDs are much more flexible, and can use a uniform URI system to reference mailboxes, mailing lists, published nodes etc.

## Central storage (IMAP4)

### ...and Shared storage

Several users belonging to a group could share a mailbox, f.ex. `helpdesk@domain.com`, with each of them having their own mailboxes as `helpdesk/alice@domain.com` and `helpdesk/bob@domain.com`. The accounts can thus link to more than one mailbox.

### ...or Temporary storage (POP3)

For automated services, the ability to download messages in a fashion similar to POP3 this would be beneficial for server storage space as well as bandwidth and management costs.

### ...or Push messages

Sometimes, the purpose of a message is just to request a confirmation, or to notify the success or failure of a process. In those cases it is reasonable to bypass the inbox, and for that the message can be sent as a push message.

#### Scenario 1. E-mail configuration

 1. Alice goes to Website.com, and registers a new account.
 2. In order to validate Alice's e-mail address Website.com sends a
    push-notification to Alice's address containing a configuration link.
 3. Alice receives this notification, and can click "Confirm" in the desktop
    notification she is presented with.

#### Scenario 2. Notifications

 * Servers, SANs, NASes, and other network devices often report conditions and
   events by mail. With IMMP these could be handled separately from other business
   correspondence.

## Message Delivery (SMTP)

The same port and protocol that is used to read and manage the mailboxes is also used to deliver messages to mailboxes. This provides a huge advantage in confiugration and management.

Additionally, filtering can be implemented as is currently for SMTP, implementing heuristic or other analysis of messages.

## Publish-Subscribe Events (XMPP)

In this concept borrowed from XMPP, messages and push-notifications can be subscribed to in a fashion managed by the user. The user can then manage his or her subscriptions as desired, and easily unsubscribe from undesired mailing
lists.

For this reason, a subscription SHOULD BE able to be initated via a URI handler such as this one:

      immp://newsletter/updates@website.com?subscribe

Each subscription is assigned a unique identifier, and metadata is fetched as
the subscription is created. This allows the user to easily get an overview of
any current subscriptions.

| UUID   | IMID^[Internet Messaging ID] | Node                   | Title                    |
|:-------|:-----------------------------|:-----------------------|:-------------------------|
| ...    | newsletter@website.com       | newsletter/updates     | Updates from Website.com |

### Publishing Events

When a website wishes to reach out to its subscribers it turns the stake. The
message is pushed to each of the subscribers, which confirm its origin and the
presence of the subscription, thus defeating a bit of unsolicited e-mailing by
flagging the real ones.

~~~~
   C:  PUSH TO noccy@noccylabs.info FROM newsletter@website.com/updates +IMPORTANT 
   S:  
~~~~



## Intrinsic Security

Encryption is an integral part of the protocol, as it does not under any
circumstances allow any information exchange to take place before the session
has been secured.

The session begins by the server indicating what methods it can use to upgrade
the connections.

The proposed methods are:

 * `SSLv3`
 * `TLS`

The key fingerprints should be compared to previously seen ones when upgrading
the connection. Messages that are flagged as `+SECURE` MUST NOT be delivered
over a connection where the fingerprint failed. The administrator always be
notified, and the server should retry delivery in 5 minutes and then according
to a defined schedule.

### No Plain-text passwords

Passwords MUST BE saved using the key derivation algorithm specified in
this draft. The output from the KDA is the effective password for the
account.

Upon the client requesting authentication using a shared secret (the generated 
password) the server sends over two nounces, that are used by both the client
and the server to calculate a key. The client sends its calculated key to the
server, and the server compares the key. If the keys match, the user is logged
in.

This way plain-text passwords are never transferred in the clear, and are
only used for key derivation.

> ***CV:*** This lacks in several aspects; first of all the passwords can be
> compromised and used to authenticate as the user. Better would be to use
> one of the nonce values as the salt, and have the user salt his copy as
> ordered by the server. Another option would be to fall back on a simpler
> scheme that allows for server-side hashed passwords.

![Authentication with Shared Secret](images/auth-secret.png)

For **IMMP 1.0** H and K are defined as:

 * *H(p)* is the key derivation algorithm.
 * *K(h,n1,n2)* is the key generation algorithm that takes the password
   hash *h*, concatenated with *n1* and *n2* and calculates the sha1 sum
   of the full string.

## Pipelining On-Demand

Any command can be pipelined, thus allowing for example several attachments
to be added at the same time issuing `AS xxxx DATA ...` rather than just
`DATA ...`.

By chaining commands using semicolons, it would be possible to initiate several downloads at once, each in its own pipeline.

![Pipelined session](images/pipelines.png)

## Commands

Commands come in the form of one or more keywords, followed by zero or more
parameters or switches:

~~~~
  AUTHENTICATE COOKIE cacabeefcacabad0 otherdomain.com
        |                     |               |
  AUTHENTICATE SECRET noccy@noccylabs.info    |
        |                     |---------------'
        '-----.               | 
           Keywords        Parameters    Switches
              |               |              '---------------------.
              |               |                                    |
  AS beef MBOX FETCH /inbox#9507ce26-d34e-41cb-9f14-4eeff943e25e +JSON -READ
        |
   Pipeline ID
~~~~

 * Keywords are written in `CAPITAL LETTERS` in this document but the parsers
   SHOULD NOT be case sensitive when parsing keywords.
 * Words in lower case should be replaced with the appropriate values.
 * Quoted strings should be used verbatim.
 * Parameters only have to be quoted if they contain spaces.
 * Switches enable or disable a certain behavior of the command.
 * Pipelines can be created by prefixing the keyword `AS` followed by the
   desired pipeline ID to use. All replies for this pipeline will have this ID
   followed by a colon prefixed to their status codes.

## Responses

~~~~
  [ pipeline ": "] status-code ["-"] " " message "\n"
       |                |       |           |      '-- Ends with newline
       |                |       |           '-- The message
       |                |       '-------- Dash for continuation
       |                '------ The numeric status code
       '------ The pipeline ID as defined with "AS"
~~~~

## Push Messages

Push-messages place a central role in IMMP. E-mail has become the current provider of web-centered push-notifications, albeit its shortcomings and quirks. IMMP aims to fix this problem by allowing the transport of both messages and notifications.

Notifications here are simplified messages, with the body reduced to a single data block.

## Blacklisting: In Case Of Spam

