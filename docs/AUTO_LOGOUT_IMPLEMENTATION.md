# Auto Logout on Inactivity - Implementation Documentation

## Overview
This document describes the auto-logout feature implementation that automatically logs out users after 30 minutes of inactivity across the application.

## Configuration
- **Inactivity Timeout**: 30 minutes (1,800,000 milliseconds)
- **Warning Time**: 5 minutes before logout (300,000 milliseconds)
- **Countdown Update**: Every 1 second (1,000 milliseconds)

## Implementation Details

### Files Modified
1. **`resources/views/layouts/admin/footer.blade.php`** ✅ (Already implemented)
2. **`resources/views/forms/layouts/footer.blade.php`** ✅ (Newly implemented)

### How It Works

#### 1. Activity Detection
The system monitors the following user activities:
- Mouse movements (`mousemove`)
- Mouse clicks (`mousedown`, `click`)
- Keyboard input (`keydown`)
- Scrolling (`scroll`, `wheel`)
- Touch events (`touchstart`)

#### 2. Timer Mechanism
- **Inactivity Timer**: Starts when the page loads and resets on each user activity
- **Warning Timer**: Triggers 5 minutes before the final logout (at 25 minutes of inactivity)
- **Countdown Timer**: Updates the warning modal every second showing remaining time

#### 3. Warning Modal
When the warning timer triggers (after 25 minutes of inactivity):
- A modal appears with Hebrew text: "אזהרת התנתקות" (Logout Warning)
- Shows countdown timer: "05:00" (5 minutes)
- Provides two options:
  - **"הישאר מחובר"** (Stay Logged In) - Resets all timers
  - **"התנתק עכשיו"** (Logout Now) - Immediately logs out

#### 4. Auto Logout
If the countdown reaches zero or user clicks "Logout Now":
- User is redirected to `/logout` route
- Session is terminated

## User Experience

### Timeline
```
0 min ──────── 25 min ──────── 30 min
         │                │
    User Active      Warning    Auto Logout
                     Modal
```

### Warning Modal Display
The modal features:
- Hebrew right-to-left (RTL) text direction
- Clear countdown display in MM:SS format
- Green "Stay" button
- Red "Logout" button
- Semi-transparent dark overlay background
- High z-index (99999) to appear above all content

## Security Features

1. **Only for Authenticated Users**: 
   - The script only loads for authenticated users (`@auth` directive)
   
2. **Activity Reset**:
   - Timer resets on any user interaction
   - Prevents accidental logout during active sessions
   
3. **No Activity During Warning**:
   - User activity during the warning period doesn't reset the timer
   - Forces user to explicitly choose to stay logged in

## Technical Implementation

### JavaScript Module Pattern
The implementation uses an IIFE (Immediately Invoked Function Expression) to create an isolated scope:

```javascript
const AutoLogout = (function() {
    // Configuration constants
    // State variables
    // Private functions
    // Public API
    return {
        init: init,
        stayLoggedIn: stayLoggedIn,
        logoutNow: logoutNow,
        resetTimer: resetTimer
    };
})();
```

### Event Listeners
All event listeners are added with `passive: true` option to improve scroll performance.

### DOM Ready Check
The script checks document readiness state to ensure proper initialization:
```javascript
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', AutoLogout.init);
} else {
    AutoLogout.init();
}
```

## Logout Route
The logout route is configured in `routes/web.php`:
```php
Route::get('logout', [LoginController::class, 'logout'])->name('logout');
Route::post('logout', [LoginController::class, 'logout'])->name('logout');
```

## Browser Compatibility
- Modern browsers (Chrome, Firefox, Safari, Edge)
- ES6 features used (const, let, arrow functions)
- String.padStart() for countdown formatting

## Customization Options

### Adjusting Timeout Duration
To change the inactivity period, modify the constants in the script:
```javascript
const INACTIVE_TIMEOUT = 30 * 60 * 1000;  // Change to desired minutes
const WARNING_TIME = 5 * 60 * 1000;       // Adjust warning time
```

### Styling
The modal styles can be customized by modifying the CSS classes:
- `.auto-logout-modal` - Modal overlay
- `.auto-logout-content` - Modal content box
- `.auto-logout-timer` - Countdown display
- `.btn-stay` / `.btn-logout` - Action buttons

## Testing Recommendations

1. **Test Inactivity**: Leave the page idle for 25 minutes to see the warning
2. **Test Activity Reset**: Move mouse or type after 20 minutes of inactivity
3. **Test "Stay Logged In"**: Click the stay button and verify timer resets
4. **Test "Logout Now"**: Click logout button and verify immediate logout
5. **Test Countdown**: Verify countdown displays correctly
6. **Test Auto Logout**: Wait for countdown to reach zero

## Troubleshooting

### Modal Not Appearing
- Check browser console for errors
- Verify user is authenticated (@auth condition)
- Check if DOM elements exist (autoLogoutModal, logoutCountdown)

### Timer Not Resetting
- Check if activity events are properly registered
- Verify event listeners are not blocked by other scripts
- Check console for "Auto-logout initialized" message

### Immediate Logout Issues
- Verify `/logout` route is accessible
- Check LoginController logout method
- Verify session configuration

## Future Enhancements

Potential improvements:
1. Make timeout configurable per user role
2. Add server-side session timeout validation
3. Store last activity timestamp in session
4. Add activity log for security auditing
5. Allow users to customize timeout in settings
6. Add sound/notification when warning appears

## Conclusion

The auto-logout feature provides essential security for the application by automatically logging out inactive users after 30 minutes, with a friendly 5-minute warning to prevent accidental logouts. The implementation is clean, efficient, and user-friendly with Hebrew localization.
