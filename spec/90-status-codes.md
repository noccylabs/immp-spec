# List of Status Codes

 * `1xx` is informative
 * `2xx` is success messages
 * `3xx` is progress updates pending a `2xx` or `4xx`
 * `4xx` is error messages
 * `7xx` is server or protocol error messages

## 1xx codes

 * `100` Logon info text
 * `101` Server info: p=**protocol** v=**version** d=**domain**

## 2xx codes

 * `204` Upgrading transport with encryption
 * `210` Authentication accepted
 * `240` Mailbox status: u=**unread**, t=**total**
 * `250` Message download in JSON format
 * `251` Message download in MIME Multipart format
 * `270` Awaiting DATA
 * `271` Awaiting content for part
 * `272` Part saved
 * `280` Subscription successful
 * `281` Subscription list item (uuid and info)
 * `282` End of subscription list

## 3xx codes

 * `301` Cookie authentication initiated
 * `302` Shared secret authentication request initiated
 * `303` Shared secret nonces: n1=**nonce1** n2=**nonce2**
 * `380` Trying to subscribe

