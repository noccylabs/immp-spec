\newpage 

# About this draft

## Conventions

 * The term *e-mail* is used throughout this document to reference the implementation specified in this draft unless otherwise specified.

> ***CV*** Maybe it would be appropriate to use *e-mail* for the old-school mail, and *i-mail* for "internet mail"? This would also indicate the paradigm change introduced by this prodocol.

 * In examples, `S:` is used to indicate a response from the server while `C:` indicates data sent by the client.

## Terminology

 * *mailbox* is a storage location for folders and messages.
 * *account* is a primary mailbox associated with login credentials.
 * *message* is one or more pieces of *data* with at least one *content* part.
 * *data* is a message chunk, such as the content in HTML or MarkDown format, an image or an attachment.

## Design Considerations

The following points are key to the design of the protocol:

 * All transport of messages or user information requires transport encryption.
 * The protocol must be plaintext and easy to follow.
 * The protocol must fill the role of the three main protocols in use today,
   namely SMTP for transport, and POP3/IMAP for retrieval/storage.
 * The protocol must not be immediately backward compatible with the previously
   mentioned protocols, for the sole reason of not compromising its integrity by
   allowing one link of the chain to fallback on insecure transports.
 * The protocol should provide a transport for high-importance push-events from
   previously approved source.
 * The protocol should authenticate originating domains, while allowing the sender
   to remain anonymous.

