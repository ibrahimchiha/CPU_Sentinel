CREATE TABLE usr(
    user_id INT,
    first_name VARCHAR(50),
    last_name VARCHAR(50),
    company VARCHAR(200) NULL,
    email VARCHAR(300),
    PRIMARY KEY(user_id)
);
CREATE TABLE Employee(
    employee_id INT,
    firstname VARCHAR(50),
    lastname VARCHAR(50),
    operating_system VARCHAR(50),
    admin_id INT,
    PRIMARY KEY(employee_id),
    FOREIGN KEY(admin_id) REFERENCES usr(user_id) ON DELETE SET NULL
);

CREATE TABLE cpu(
    cpu_id INT,
    manufacturer VARCHAR(50),
    model_nb VARCHAR(50),
    nb_cores INT,
    base_clock_speed_ghz FLOAT,
    nb_threads INT,
    boost_clock_speed_ghz FLOAT,
    cache_size_mb INT,
    architecture CHAR(1),
    employee_id INT,
    cpu_usage INT,
    PRIMARY KEY(cpu_id),
    FOREIGN KEY(employee_id) REFERENCES Employee(employee_id) ON DELETE SET NULL
);

CREATE TABLE gpu(
    gpu_id INT,
    manufacturer VARCHAR(50),
    base_clcok_mhz INT,
    boost_clock_mhz INT,
    memory_size_gb INT,
    memory_type VARCHAR(50),
    memory_clock_mhz INT,
    gpu_usage INT,
    employee_id INT,
    model_nb VARCHAR(200),
    PRIMARY KEY(gpu_id),
    FOREIGN KEY(employee_id) REFERENCES Employee(employee_id) ON DELETE SET NULL
);

CREATE TABLE ram(
    ram_id INT,
    manufacturer VARCHAR(50),
    model_nb VARCHAR(200),
    capacity_gb INT,
    stick_type VARCHAR(20),
    cell_type VARCHAR(20),
    clock_freq_mhz INT,
    ram_usage INT,
    employee_id INT,
    PRIMARY KEY(ram_id),
    FOREIGN KEY(employee_id) REFERENCES Employee(employee_id) ON DELETE SET NULL

);

CREATE TABLE storage_drive(
    storage_drive_id INT,
    manufacturer VARCHAR(50),
    model_nb VARCHAR(50),
    drive_type VARCHAR(50),
    max_bandwidth_mbps INT,
    interface VARCHAR(50),
    capacity_mb INT,
    dram_cache_gb INT,
    employee_id INT,
    remaining_capacity_mb INT,
    PRIMARY KEY(storage_drive_id),
    FOREIGN KEY(employee_id) REFERENCES Employee(employee_id) ON DELETE SET NULL

);

CREATE TABLE BATTERY(
    battery_id INT,
    manufacturer VARCHAR(50),
    model_nb VARCHAR(200),
    battery_type VARCHAR(50),
    capacity_wh INT,
    nb_cells INT,
    capacity_mah INT,
    voltage INT,
    time_remaining_sec INT,
    percentage_remaining INT,
    employee_id INT,
    PRIMARY KEY(battery_id),
    FOREIGN KEY(employee_id) REFERENCES Employee(employee_id) ON DELETE SET NULL
);