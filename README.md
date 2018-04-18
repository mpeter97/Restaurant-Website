This website is based off of the Five Guys Burger Restaurant website.

Contributors: Matt Peter, Greg Smith, and Jonah Kubath



The Home page has a comment section that shows approved comments by the owner.  Users can also submit comments/concerns from the main page.



The Menu displays items based on what is offered at the location selected by the user.  The nutrition facts are also generated by what ingredients go into the items.



The Order page needs a user to be loggged in to place an order.  The user is re-directed to the login page if they are not logged in.  After a user is logged in, the store locations are displayed and once one is selected, the items that  are offered there are displayed.  The user can then select which items they want to add to their order or save a specific combination of burger ingredients to their "Custom Burgers".  Items can be edited by adding or removing ingredients.  Toppings that have an additional cost associated with them are added to the total cost of the item.



The Locations page is made by implementing the Google Maps API.  The locations are made through a php file that generates the XML file.  The XML file is read and displayed on the map.



There are also four different levels of accounts: Customers, Employee, Manager, Owner.
  
Customers simply have the features as explained above.
Employees can login and with a manger's approval, see the active orders for their location, and fulfill these orders.

Managers can edit which items are offered at the stores they manage.

Owners can create new items and also make all stores offer certain items.