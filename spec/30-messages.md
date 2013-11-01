# Messages

Messages in IMMP generally consist of an outer envelope, an inner envelope and the message content. The outer envelope is always unencrypted (not considering the transport encryption) in the message. The inner envelope is encrypted with the reciving servers' public key to guarantee anonymity up until the point that the message is delivered to the recipient.

The outer envelope contains enough information to address the recipient's server. Imagine `alice@adomain.com` sends a message to `bob@bdomain.com`. In this case the outer envelope would be addressed to `bdomain.com` and signed with the private key of `adomain.com`. The inner envelope would be addressed to `bob@bdomain.com` and encrypted with the public key of `bdomain.com`. 

The advantages of this solution includes:

 1. Verification of the sending domain (which might be different than the delivering servers domain in the case of forwarding or proxies.
 2. The final destination exposed in plain text does not point to an account or mailbox, but rather a domain. Only that domain can resolve the mailbox. Thus full anonymity of the sender and the recipient is ensured, even when relaying servers are involved.
 3. Messages can not be easily tampered with, and even if they could the outer envelope does not provide enough information to cherrypick a specific message without additional knowledge about the exact circumstances.

## Representation

Message headers are stored as JSON format. Additional compression capabilities can be requested with the `SET` command.

~~~~{.js}
        {
            "envelope":{
                "immp-origin": "adomain.com",
                "immp-destination": "bdomain.com",
                "immp-recipient": [
                    // ...base64-encoded inner envelope(s)...
                ],
                "received-from": { 
                    "domain": "mail.cdomain.com"
                    "timestamp": "2013-10-29T02:40:28+01:00",
                },
                "received-via": [
                    {
                        "domain": "mail.cdomain.com",
                        "timestamp": "2013-10-29T02:40:26+01:00"
                    }
                    // ...list of routing servers and timestamps
                ]
            }
        }
~~~~

## Encapsulation

> ***CV*** *Something PGP-like to ensure only the sender and the recipient can read the message?*


## Metadata

### Outer Envelope

 * Information on the origin domain
 * Information on the destination domain
 * Encrypted inner envelopes with information about the recipients
 * Routing information (received from, via)

### Inner Envelope

 * Recipient information
 * Additional metadata

### Message Content

## Requesting compression

Compression is controlled via the setting `compression`.

~~~~
  C:  SET COMPRESSION
  S:  xxx-COMPRESSION=NONE
  S:  xxx NONE, GZIP, BZIP2, XZIP
  C:  SET COMPRESSION=GZIP
  S:  xxx COMPRESSION=GZIP
~~~~

