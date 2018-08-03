# Left Field Brewery Theme

## Development

In order to run the theme for development, you will need to have 2 terminal processes.

In the first terminal, run `yarn run server`. This starts a browser sync proxy server on [http://localhost:3000](http://localhost:3000). It will watch for changes and refresh the page.

In the second terminal run `yarn run dev`. This runs gulp (right now only needed for styles and should eventually be depreciated) as well as parcel, which compiles everything except the styles.

With these 2 going, you are ready to start developing.
