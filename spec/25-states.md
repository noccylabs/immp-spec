## The Protocol States

The protocol is divided up into a number of phases, or states, each allowing a specific
subset of the supported commands.

1. **Unencrypted** - In this phase only commands to upgrade the transport are allowed. No messages can be delivered, and no authentication can be made.
2. **Unauthenticated** - In this phase only authentication commands (local users as well as remote cookies) or push-events are allowed.
3. **Local Authenticated** - can access mailboxes and send mail.
4. **Remotely Authenticated** - Can deliver mail to local mailboxes.

