# WooCommerce Subscriptions Delivery Date Plugin

## Description

This plugin extends WooCommerce Subscriptions by adding a "Delivery Date" field to both simple and variable subscription products. Admins can set a recurring delivery date (e.g., the 3rd day of every 2 weeks, or 1st day of every month). The next three recurring dates will be displayed on the product page in a drop-down menu. Customers can select a delivery date which will be displayed in the cart and checkout pages.

## Features

- Adds a "Delivery Date" field to the WooCommerce product editor for subscription products.
- Admins can choose recurring periods (e.g., every 2 weeks, every month, every 6 months).
- Displays the next three recurring delivery dates on the product page.
- Allows customers to select a delivery date which is then shown in the cart and checkout pages.
- Customers can edit the delivery date in the cart and checkout pages.

## Installation

1. Download the plugin files and extract them.
2. Upload the plugin folder to the `/wp-content/plugins/` directory.
3. Activate the plugin through the 'Plugins' menu in WordPress.

## Usage

1. **Setting Delivery Date in Admin:**
   - Edit a subscription product.
   - In the product data section, go to the "General" tab.
   - Select the delivery date period (every 2 weeks, every month, every 6 months).
   - Save the product.

2. **Customer Selection:**
   - On the product page, customers will see a drop-down menu to select the delivery date.
   - The selected delivery date will be added to the cart.
   - In the cart and checkout pages, customers can edit the delivery date from the drop-down menu.

## Functions

### Admin Functions

- **`add_delivery_date_field`**: Adds the delivery date field to the product editor.
- **`save_delivery_date_field`**: Saves the delivery date field data when the product is updated.
- **`calculate_recurring_dates`**: Calculates recurring dates based on the period selected by the admin.

### Frontend Functions

- **`display_recurring_dates`**: Displays the delivery date field on the product page.
- **`add_delivery_date_to_cart_item`**: Adds delivery date to cart item data.
- **`display_delivery_date_cart`**: Displays the delivery date in the cart (non-editable).
- **`add_delivery_date_cart_editable`**: Makes the delivery date editable in the cart.
- **`update_delivery_date_cart`**: Updates the delivery date in the cart.
- **`display_delivery_date_checkout`**: Displays the delivery date field on the checkout page.
- **`update_delivery_date_order_meta`**: Updates the delivery date in the order meta.

## Changelog

### 1.0.0

- Initial release with core features.

## Frequently Asked Questions

**Q:** How do I set the delivery date period for a product?
**A:** Edit the product in the admin area, and under the "General" tab, you will find the delivery date period options.

**Q:** Can customers change the delivery date after adding a product to the cart?
**A:** Yes, customers can edit the delivery date in the cart and checkout pages.

## Support

For support, please contact [Your Support Email].

## License

This plugin is licensed under the GPL v2 or later.
