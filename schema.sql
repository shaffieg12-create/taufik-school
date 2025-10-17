PRAGMA foreign_keys = ON;
CREATE TABLE classes(
id INTEGER PRIMARY KEY,
name TEXT,
section TEXT, -- nursery, primary, quran
day_fee INTEGER,
boarding_fee INTEGER
);
CREATE TABLE students(
id INTEGER PRIMARY KEY,
code TEXT UNIQUE, -- TJS23-0001
first_name TEXT, last_name TEXT,
gender TEXT, dob DATE,
class_id INTEGER REFERENCES classes(id),
boarding INTEGER DEFAULT 0,
quran_hifz INTEGER DEFAULT 0,
parent_phone TEXT,
parent_email TEXT,
password TEXT, -- for parent app
avatar TEXT,
allergies TEXT,
status INTEGER DEFAULT 1
);
CREATE TABLE fee_invoices(
id INTEGER PRIMARY KEY,
student_id INTEGER REFERENCES students(id),
term TEXT, -- 2025-T3
total INTEGER,
paid INTEGER DEFAULT 0,
balance GENERATED ALWAYS AS (total-paid) STORED,
due_date DATE
);
CREATE TABLE attendance(
id INTEGER PRIMARY KEY,
student_id INTEGER,
date TEXT,
time TEXT,
direction TEXT, -- IN / OUT
reader_id TEXT, -- gate, dorm, library
synced INTEGER DEFAULT 1
);
CREATE TABLE users(
id INTEGER PRIMARY KEY,
name TEXT, email TEXT UNIQUE, password TEXT, role INTEGER
);
-- (more tables: discipline, stock, payroll, dorm_beds, library_books…)
