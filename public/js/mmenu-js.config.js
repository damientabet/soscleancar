document.addEventListener(
    "DOMContentLoaded", () => {
        new Mmenu("#menu", {
            // A collection of extension names to enable for the menu.
            extensions: [
                "theme-dark",
                "pagedim-black",
                "shadow-page"
            ],
            backButton: {
                close: true
            },
            onClick: {
                // whether or not the menu should close after clicking a link inside it.
                close: true,
                // prevent the default behavior for the clicked link
                preventDefault: null,
                // the clicked link should be visibly "selected".
                setSelected: true
            },
            // the submenus comes sliding in from the right.
            slidingSubmenus: true,
            // a collection of framework wrappers to enable for the menu.
            wrappers: ['bootstrap'],
            // off-canvas addon options
            offCanvas: {
                // Whether or not to block the user from using the page while the menu is opened.
                // If set to "modal", clicking outside the menu does not close it.
                blockUI: true,
                // Whether or not the page should inherit the background of the body when the menu opens.
                moveBackground: true
            },
            // Screen reader addon options
            screenReader: {
                // Whether or not to automatically add and up<a href="#!">date</a> the aria-hidden and aria-haspopup attributes.
                aria: true,
                // Whether or not to add a "screen reader only" text for anchors that normally don't have text.
                text: true
            },
            // <a href="#!">Scroll</a> bug fix addon options
            scrollBugFix: {
                fix: true // fix the scroll bug on touchscreens
            }
        });
    }
);