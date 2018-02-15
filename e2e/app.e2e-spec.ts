import { Angular2WorkshopPage } from './app.po';

describe('angular2-workshop App', function() {
  let page: Angular2WorkshopPage;

  beforeEach(() => {
    page = new Angular2WorkshopPage();
  });

  it('should display message saying app works', () => {
    page.navigateTo();
    expect(page.getParagraphText()).toEqual('app works!');
  });
});
