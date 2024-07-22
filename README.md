# TM Derby Schedule

![tmderbyschedule](https://github.com/heliogoodbye/TM-Derby-Schedule/assets/105381685/119f1c71-a0fe-4fee-8d72-e7389f9ccb88)

**TM Derby Schedule** is a customizable WordPress plugin that helps roller derby leagues and teams manage and showcase their game schedules on their website. It supports displaying detailed information about each game, including date, time, teams, venue, location, and relevant links.

#### **Features:**

1. **Shortcode Integration:**
   - The plugin provides a shortcode `[tm_derby_schedule]` to embed the game schedule anywhere on your WordPress site. You can customize the display using various shortcode attributes.

2. **Customizable Display:**
   - **Attributes:**
     - `count`: Limits the number of games shown. Default is `-1` (all games).
     - `view`: Chooses between a "full" or "reduced" view. "Full" view displays complete details, while "reduced" view shows only the date and game name.
     - `show_past`: When set to `true`, past games are displayed with reduced opacity. Past games will not include "Buy Tickets" or "Facebook Events" links.

3. **Game Information Displayed:**
   - **Date and Time:** The date and time of the game are shown in a user-friendly format.
   - **Teams:** Displays team names for up to three games if applicable.
   - **Venue and Location:** Information about where the game is held.
   - **Tickets:** If available, a link to purchase tickets is provided.
   - **Facebook Events:** A link to the Facebook event, if applicable.

4. **Styling:**
   - The plugin uses CSS classes to apply different styles based on whether a game is upcoming or past. Past games are displayed with reduced opacity to distinguish them from future games.

5. **Responsive Design:**
   - The plugin ensures that the schedule display is responsive and works well on various devices, including desktops, tablets, and smartphones.

6. **User-Friendly:**
   - Easy to use with shortcodes that can be added to posts, pages, or widgets.
   - Flexible configuration via shortcode attributes.

7. **Data Handling:**
   - Utilizes custom fields to store game details.
   - Queries the WordPress database to fetch and display game data dynamically.

8. **Fallback Content:**
   - If no games are available, a message like "No upcoming games. See you next season!" is displayed.

#### **Usage Examples:**

- **Show a maximum of 5 upcoming games in full view:**
  ```html
  [tm_derby_schedule count="5" view="full"]
  ```

- **Show all games with past games included in reduced opacity and no links:**
  ```html
  [tm_derby_schedule count="-1" view="full" show_past="true"]
  ```

This plugin is ideal for roller derby leagues and teams that need an easy way to keep fans updated about their game schedules and provide essential information about each event.

---

# How to use TM Derby Schedule

To use the **TM Derby Schedule** plugin, follow these steps:

### **1. Install the Plugin**

1. **Upload the Plugin:**
   - Download the plugin zip file.
   - Go to your WordPress admin dashboard.
   - Navigate to **Plugins** > **Add New**.
   - Click **Upload Plugin**, then choose the zip file and click **Install Now**.

2. **Activate the Plugin:**
   - Once installed, click **Activate Plugin**.

### **2. Add Game Data**

1. **Add Games:**
   - Go to **Events** (or a similar custom post type created by the plugin) in your WordPress admin dashboard.
   - Click **Add New** to create a new game entry.
   - Fill in the details for each game, such as date, time, teams, venue, location, and any ticket or Facebook event links.
   - Publish the game entry.

### **3. Insert the Shortcode**

1. **Choose Where to Display:**
   - Decide where you want to display the game schedule on your site (e.g., a page, post, or widget).

2. **Add Shortcode:**
   - Edit the page, post, or widget area where you want to display the schedule.
   - Insert the shortcode with your desired attributes. For example:

     - **Display upcoming games only:**
       ```html
       [tm_derby_schedule count="5" view="full"]
       ```
     - **Display all games, including past games with reduced opacity:**
       ```html
       [tm_derby_schedule count="-1" view="full" show_past="true"]
       ```

3. **Save Changes:**
   - Update or publish the page or post where you added the shortcode.

### **4. Customize Display (Optional)**

1. **Styling:**
   - You can customize the appearance of the game schedule by adding custom CSS in your theme’s stylesheet or through the WordPress Customizer.

2. **Additional Configuration:**
   - If needed, you can adjust the plugin’s settings or add custom fields to tailor the schedule display to your preferences.

### **5. Verify and Update**

1. **Check Display:**
   - Visit the page or post where you added the shortcode to ensure the schedule is displaying correctly.

2. **Update Game Information:**
   - Keep your game schedule up to date by editing existing game entries or adding new ones as needed.

By following these steps, you can effectively manage and display your roller derby game schedule on your WordPress site using the TM Derby Schedule plugin.
  
---

## Disclaimer

This WordPress plugin is provided without warranty. As the program is licensed free of charge, there is no warranty for the program, to the extent permitted by applicable law. The entire risk as to the quality and performance of the program is with you. Should the program prove defective, you assume the cost of all necessary servicing, repair, or correction.

In no event unless required by applicable law or agreed to in writing will the authors or copyright holders be liable to you for damages, including any general, special, incidental, or consequential damages arising out of the use or inability to use the program (including but not limited to loss of data or data being rendered inaccurate or losses sustained by you or third parties or a failure of the program to operate with any other programs), even if such holder or other party has been advised of the possibility of such damages.
