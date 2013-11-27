# About this draft

## Conventions

 * The term *e-mail* is used throughout this document to reference the implementation specified in this draft unless otherwise specified.

> ***CV*** Maybe it would be appropriate to use *e-mail* for the old-school mail, and *i-mail* for "Internet mail"? This would also indicate the paradigm change introduced by this protocol.

 * In examples, `S:` is used to indicate a response from the server while `C:` indicates data sent by the client.

## Terminology

 * *mailbox* is a storage location for folders and messages.
 * *account* is a primary mailbox associated with login credentials.
 * *message* is one or more pieces of *data* with at least one *content* part.
 * *data* is a message chunk, such as the content in HTML or Markdown format, an image or an attachment.

## Design Considerations

The following points are key to the design of the protocol:

 * All transport of messages or user information requires transport encryption.
 * The protocol must be plain-text and easy to follow.
 * The protocol must fill the role of the three main protocols in use today, namely SMTP for transport, and POP3/IMAP for retrieval/storage.
 * The protocol must not be immediately backward compatible with the previously mentioned protocols, for the sole reason of not compromising its integrity by allowing one link of the chain to fall back on insecure transports.
 * The protocol should provide a transport for high-importance push-events from previously approved sources, as well as a method to manage the aforementioned approved sources and unapproved messages.
 * The protocol should authenticate originating domains, while allowing the sender to remain anonymous.
 * The protocol, or more precisely the IMIDs should be compatible with XMPP to provide instant messaging and more.

## Authors

 * **Christopher Vagnetoft** (NoccyLabs)