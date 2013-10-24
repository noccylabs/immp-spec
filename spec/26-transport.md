## Message Transport

![Message transport over the Internet](images/immp-delivery.dot)

### Over TCP

Over TCP it is suggested that IMMP use a port such as `1025`, hinting at the old SMTP port number.

The TCP transport is the primary focus of this draft.

### Over XMPP

This is a thrilling new use of XMPP as the middleman in delivering messages between two IMMP servers. XMPP already has a number of advantages over IMMP in this aspect, such as:

 * **Persistent Connections** - Connections between XMPP-servers are in many cases persistent, especially when between a bigger XMPP service provider and another server. This could be great for IMMP as it would remove the overhead of establishing a connection and upgrading a session. The problem would be if a server upstream would lack encryption. This can however be solved by armoring the message with encryption before sending over an XMPP transport.
 * **Encryption** - Encryption is well defined and readily used to secure XMPP connections already. This adds to the transport security.
